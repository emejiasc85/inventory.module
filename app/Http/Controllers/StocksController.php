<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::where('warehouse_id', 1)->OrderBy('id', 'DESC')->paginate();
        return view('stocks.index', compact('stocks'));
    }
}
