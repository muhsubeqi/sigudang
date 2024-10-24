<?php

namespace App\Http\Controllers;

use App\Helper\AutoGetCode;
use App\Models\Item;
use App\Models\ItemTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class ItemTransactionController extends Controller
{
    protected array $rules = [
        'invoice' => 'required',
        'item_id' => 'required',
        'qty' => 'required',
        'date' => 'required',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = [
            ["data" => 'DT_RowIndex', "name" => 'DT_RowIndex', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'invoice', "name" => 'invoice'],
            ["data" => 'item', "name" => 'item', "class" => "align-middle"],
            ["data" => 'qty', "name" => 'qty', "class" => "align-middle"],
            ["data" => 'date', "name" => 'date', "class" => "align-middle"],
            ["data" => 'user', "name" => 'user', "sortable" => false, "searchable" => false],
        ];

        if (Gate::allows('item-transaction.edit') || Gate::allows('item-transaction.delete')) {
            $columns[] = ["data" => 'action', "name" => 'action', "sortable" => false, "searchable" => false];
        }

        $items = Item::all();

        return view('pages.item-transaction.index', compact('items', 'columns'));
    }

    public function list(Request $request, $status)
    {
        $data = ItemTransaction::with('item', 'user')
            ->where('status', $status)
            ->select('*');

        if ($status == 'in') {
            $codeFormat = AutoGetCode::store($data, 'TM', 'invoice');
        } else {
            $codeFormat = AutoGetCode::store($data, 'TK', 'invoice');
        }

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('item', function (ItemTransaction $itemTransaction) {
                return $itemTransaction->item->code . ' - ' . $itemTransaction->item->name;
            })
            ->editColumn('user', function (ItemTransaction $itemTransaction) {
                return $itemTransaction->user->name;
            })
            ->editColumn('date', function (ItemTransaction $itemTransaction) {
                return Carbon::parse($itemTransaction->date)->format('d-m-Y');
            })
            ->addColumn('action', function (ItemTransaction $itemTransaction) {
                return view('pages.item-transaction.partials.action', ['row' => $itemTransaction]);
            })
            ->rawColumns(['item', 'user', 'date', 'action'])
            ->with('codeFormat', $codeFormat)
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $status)
    {
        try {
            \DB::beginTransaction();
            $dataValidated = $request->validate($this->rules);
            $dataValidated['status'] = $status;
            $dataValidated['user_id'] = auth()->user()->id;
            $dataValidated['date'] = Carbon::parse($dataValidated['date'])->format('Y-m-d');
            $itemTransaction = ItemTransaction::create($dataValidated);

            $item = Item::find($dataValidated['item_id']);
            if ($status == 'in') {
                $item->stock = $item->stock + $dataValidated['qty'];
            } else {
                $item->stock = $item->stock - $dataValidated['qty'];
            }
            $item->save();

            $data = [
                'status' => 200,
                'message' => 'Berhasil menambahkan data barang ' . ($status == 'in' ? 'masuk' : 'keluar'),
            ];

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
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
    public function update(Request $request, ItemTransaction $itemTransaction, $status)
    {
        try {
            \DB::beginTransaction();
            $dataValidated = $request->validate($this->rules);
            $dataValidated['status'] = $status;
            $dataValidated['user_id'] = auth()->user()->id;
            $dataValidated['date'] = Carbon::parse($dataValidated['date'])->format('Y-m-d');
            $itemTransaction->update($dataValidated);

            $item = Item::find($dataValidated['item_id']);
            if ($status == 'in') {
                $item->stock = $item->stock + $dataValidated['qty'];
            } else {
                $item->stock = $item->stock - $dataValidated['qty'];
            }
            $item->save();

            $data = [
                'status' => 200,
                'message' => 'Berhasil mengupdate data barang ' . ($status == 'in' ? 'masuk' : 'keluar'),
            ];

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
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
    public function destroy(ItemTransaction $itemTransaction, $status)
    {
        try {
            \DB::beginTransaction();
            $itemTransaction->delete();

            $item = Item::find($itemTransaction->item_id);
            if ($status == 'in') {
                $item->stock = $item->stock - $itemTransaction->qty;
            } else {
                $item->stock = $item->stock + $itemTransaction->qty;
            }
            $item->save();

            $data = [
                'status' => 200,
                'message' => 'Berhasil menghapus data barang ' . ($status == 'in' ? 'masuk' : 'keluar'),
            ];

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
            $data = [
                'status' => 500,
                'message' => 'Error, telah terjadi kesalahan sistem',
            ];
        }
        return response()->json($data);
    }
}
