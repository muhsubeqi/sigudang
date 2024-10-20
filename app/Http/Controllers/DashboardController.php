<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $inItemTransactions = ItemTransaction::where('status', 'in')->count();
        $outItemTransactions = ItemTransaction::where('status', 'out')->count();
        $users = User::count();

        $items = Item::query()->with('type', 'unit');
        $minimumStock = Item::where('stock', '<=', 0)->get();

        return view('pages.dashboard.index', compact('items', 'inItemTransactions', 'outItemTransactions', 'users', 'minimumStock'));
    }
}