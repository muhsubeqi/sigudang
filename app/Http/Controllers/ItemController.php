<?php

namespace App\Http\Controllers;

use App\Helper\FileStorage;
use App\Helper\AutoGetCode;
use App\Models\Item;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    protected array $rules = [
        'code' => 'required',
        'name' => 'required',
        'unit_id' => 'required',
        'type_id' => 'required',
        'stock' => 'required',
        'image' => 'nullable',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = [
            ["data" => 'DT_RowIndex', "name" => 'DT_RowIndex', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'code', "name" => 'code', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "class" => "align-middle"],
            ["data" => 'unit', "name" => 'unit', "class" => "align-middle"],
            ["data" => 'type', "name" => 'type', "class" => "align-middle"],
            ["data" => 'stock', "name" => 'status', "class" => "align-middle"],
            ["data" => 'image', "name" => 'image', "sortable" => false, "searchable" => false],
        ];

        if (Gate::allows('item.edit') || Gate::allows('item.delete')) {
            $columns[] = ["data" => 'action', "name" => 'action', "sortable" => false, "searchable" => false];
        }

        $units = Unit::all();
        $types = Type::all();

        return view('pages.item.index', compact('units', 'types', 'columns'));
    }

    public function list(Request $request)
    {
        $data = Item::select('*');
        $codeFormat = AutoGetCode::store($data, 'B', 'code');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('image', function (Item $item) {
                if ($item->image) {
                    return '<img src="' . asset('storage/images/item/' . $item->image) . '" width="50px" height="50px" />';
                }
            })
            ->editColumn('unit', function (Item $item) {
                return $item->unit->name;
            })
            ->editColumn('type', function (Item $item) {
                return $item->type->name;
            })
            ->addColumn('action', function (Item $item) {
                return view('pages.item.partials.action', ['row' => $item]);
            })
            ->rawColumns(['image', 'action'])
            ->with('codeFormat', $codeFormat)
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
                $path = 'public/images/item';
                $filename = FileStorage::upload($image, $path);
                $dataValidated['image'] = $filename;
            }

            $item = Item::create($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'Barang berhasil di tambahkan',
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
    public function update(Request $request, Item $item)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            if ($request->has('image')) {
                $image = $request->file('image');
                $path = 'public/images/item/';
                if ($item->image) {
                    FileStorage::delete($item->image, $path);
                }
                $filename = FileStorage::upload($image, $path);
                $dataValidated['image'] = $filename;
            }

            $item->update($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'Barang berhasil di update',
                'data' => $item
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
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        try {
            if ($item->image) {
                $path = 'public/images/item/';
                FileStorage::delete($item->image, $path);
            }
            $item->delete();
            $data = [
                'status' => 200,
                'message' => 'Berhasil menghapus data barang',
            ];
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                $data = [
                    'status' => 500,
                    'message' => 'Data barang tidak bisa dihapus karena sudah tercatat pada Data Transaksi',
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

    public function select(Item $item)
    {
        return response()->json($item);
    }
}