<?php

namespace App\Http\Controllers;

use App\Helper\FileStorage;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    protected array $rules = [
        'name' => 'required',
        'description' => 'nullable',
        'image' => 'nullable',
    ];

    public function index()
    {
        $columns = [
            ["data" => 'DT_RowIndex', "name" => 'DT_RowIndex', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'image', "name" => 'image', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "class" => "align-middle"],
            ["data" => 'description', "name" => 'description', "class" => "align-middle"],
        ];

        if (Gate::allows('type.edit') || Gate::allows('type.delete')) {
            $columns[] = ["data" => 'action', "name" => 'action', "class" => 'align-middle', "sortable" => false, "searchable" => false];
        }

        return view('pages.type.index', compact('columns'));
    }

    public function list(Request $request)
    {
        $data = Type::select('*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('image', function (Type $type) {
                if ($type->image) {
                    return '<img src="' . asset('storage/images/type/' . $type->image) . '" width="50px" height="50px" />';
                }
            })
            ->addColumn('action', function (Type $type) {
                return view('pages.type.partials.action', ['row' => $type]);
            })
            ->rawColumns(['image', 'action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            if ($request->has('image')) {
                $image = $request->file('image');
                $path = 'public/images/type';
                $filename = FileStorage::upload($image, $path);
                $dataValidated['image'] = $filename;
            }

            $type = Type::create($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'Berhasil menambahkan data jenis barang',
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Error, telah terjadi kesalahan sistem',
            ];
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            if ($request->has('image')) {
                $image = $request->file('image');
                $path = 'public/images/type/';
                if ($type->image) {
                    FileStorage::delete($type->image, $path);
                }
                $filename = FileStorage::upload($image, $path);
                $dataValidated['image'] = $filename;
            }

            $type->update($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'Berhasil mengupdate data jenis barang',
                'data' => $type
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Error, telah terjadi kesalahan sistem',
            ];
        }
        return response()->json($data);
    }

    public function destroy(Type $type)
    {
        try {

            if ($type->image) {
                $path = 'public/images/type/';
                FileStorage::delete($type->image, $path);
            }

            $type->delete();
            $data = [
                'status' => 200,
                'message' => 'Berhasil menghapus data jenis barang',
            ];
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                $data = [
                    'status' => 500,
                    'message' => 'Data jenis barang tidak bisa dihapus karena sudah tercatat pada Data Barang.',
                ];
                return response()->json($data);
            }

            $data = [
                'status' => 500,
                'message' => 'Error, telah terjadi kesalahan sistem',
            ];
        }
        return response()->json($data);
    }
}