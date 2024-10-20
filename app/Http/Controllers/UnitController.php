<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    protected array $rules = [
        'name' => 'required',
    ];

    public function index()
    {
        $columns = [
            ["data" => 'DT_RowIndex', "name" => 'DT_RowIndex', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "class" => "align-middle"],
        ];

        if (Gate::allows('unit.edit') || Gate::allows('unit.delete')) {
            $columns[] = ["data" => 'action', "name" => 'action', "class" => 'align-middle', "sortable" => false, "searchable" => false];
        }

        return view('pages.unit.index', compact('columns'));
    }

    public function list(Request $request)
    {
        $data = Unit::select('*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', function (Unit $unit) {
                return view('pages.unit.partials.action', ['row' => $unit]);
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            $unit = Unit::create($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'Berhasil menambahkan data satuan',
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
    public function update(Request $request, Unit $unit)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            $unit->update($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'Berhasil mengupdate data satuan',
                'data' => $unit
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Error, telah terjadi kesalahan sistem',
            ];
        }
        return response()->json($data);
    }

    public function destroy(Unit $unit)
    {
        try {

            $unit->delete();
            $data = [
                'status' => 200,
                'message' => 'Berhasil menghapus data satuan',
            ];
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                $data = [
                    'status' => 500,
                    'message' => 'Data satuan tidak bisa dihapus karena sudah tercatat pada Data Barang.',
                ];
                return response()->json($data);
            }

            $data = [
                'status' => 200,
                'message' => 'error, telah terjadi kesalahan sistem',
            ];
        }
        return response()->json($data);
    }
}