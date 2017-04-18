<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Order,Commerce,Stock};
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function details(Request $request, Order $order)
    {
        $data = $request->all();
        $data = array_where($data, function ($value, $key) {
            return is_string($value);
        });

        if (empty($data)) {
            $products = [];
        }else{
            $products = Stock::selectRaw(' products.full_name, products.id as id , sum(stock) as stock, (sum(order_details.sale_price) / count(stock)) as sale_price')
                ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
                ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
                ->where('products.name','LIKE', "%$request->name%")
                ->where('status', true)
                //->orWhere('products.id', $request->id)
                //->orWhere('products.barcode', $request->barcode)
                ->groupBy('products.full_name', 'products.id')
                ->get();
        }
        $commerce = Commerce::first();
        return view('bills.show', compact('order', 'commerce', 'products'));
    }
}
