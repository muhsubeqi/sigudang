<?php

namespace App\Http\Controllers;

use App\Exports\Report\ItemTransactionExport;
use App\Exports\Report\StockExport;
use App\Models\Item;
use App\Models\ItemTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function stock()
    {
        $columns = [
            ["data" => 'DT_RowIndex', "name" => 'DT_RowIndex', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'code', "name" => 'code', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "class" => "align-middle"],
            ["data" => 'type', "name" => 'type', "class" => "align-middle"],
            ["data" => 'stock', "name" => 'status', "class" => "align-middle"],
            ["data" => 'unit', "name" => 'unit', "class" => "align-middle"],
        ];

        return view('pages.report.stock.index', compact('columns'));
    }

    public function stockList(Request $request)
    {
        $data = Item::select('*')
            ->when($request->stock == 'minimum', function ($query) use ($request) {
                $query->where('stock', '0');
            });

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('stock', function (Item $item) {
                return $item->stock == 0 ? '<span class="badge bg-warning">' . $item->stock . '</span>' : $item->stock;
            })
            ->editColumn('unit', function (Item $item) {
                return $item->unit->name;
            })
            ->editColumn('type', function (Item $item) {
                return $item->type->name;
            })
            ->rawColumns(['stock'])
            ->toJson();
    }

    public function stockExport(Request $request)
    {
        $stock = $request->stock == 'minimum' ? 'Minimum' : 'Seluruh';
        return Excel::download(new StockExport($stock), 'Laporan Stok ' . $stock . ' Barang.xlsx');
    }

    public function itemTransaction()
    {
        $columns = [
            ["data" => 'DT_RowIndex', "name" => 'DT_RowIndex', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'invoice', "name" => 'invoice', "sortable" => false, "searchable" => false],
            ["data" => 'date', "name" => 'date', "class" => "align-middle"],
            ["data" => 'item', "name" => 'item', "class" => "align-middle"],
            ["data" => 'qty', "name" => 'qty', "class" => "align-middle"],
            ["data" => 'unit', "name" => 'unit', "class" => "align-middle"],
        ];
        return view('pages.report.item-transaction.index', compact('columns'));
    }

    public function itemTransactionList(Request $request, $status)
    {
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
        $data = ItemTransaction::with('item')
            ->whereBetween('date', [$startDate, $endDate])
            ->when($status == 'in', function ($query) {
                $query->where('status', 'in');
            })
            ->when($status == 'out', function ($query) {
                $query->where('status', 'out');
            })
            ->select('*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('item', function (ItemTransaction $itemTransaction) {
                return $itemTransaction->item->name;
            })
            ->addColumn('unit', function (ItemTransaction $itemTransaction) {
                return $itemTransaction->item->unit->name;
            })
            ->toJson();
    }

    public function itemTransactionExport(Request $request, $status)
    {
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

        return Excel::download(new ItemTransactionExport($status, $startDate, $endDate), 'Laporan Barang Masuk - ' . $status . ' - ' . $startDate . ' - ' . $endDate . '.xlsx');
    }
}