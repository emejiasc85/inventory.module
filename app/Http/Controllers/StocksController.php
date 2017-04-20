<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->dueDate($request->get('from_due'), $request->get('to_due'))
            ->stock($request->get('simbol'), $request->get('stock'))
            ->where('status', true)
            //->OrderBy('id', 'DESC')
            ->paginate();
        return view('stocks.index', compact('stocks'));
    }
}
