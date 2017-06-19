<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Commerce,Order,Product,Stock};
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Order::select('orders.*')->where('order_type_id', 4)
            ->peopleName($request->people_name)
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return view('quotes.index', compact('quotes'));
    }
    public function details(Request $request, Order $order)
    {
        $data = $request->all();
        /*
        $products = Product::selectRaw('products.full_name, products.id as id , sum(stock) as stock, (sum(order_details.sale_price) / count(stock)) as sale_price')
                ->where('products.name','LIKE', "%$request->name%")
                ->leftJoin('order_details', 'order_details.product_id', '=', 'products.id' )
                ->leftJoin('stocks', 'stocks.order_detail_id', '=', 'order_details.id' )
                ->groupBy('products.full_name', 'products.id')
                ->get();
        */


        $data = array_where($data, function ($value, $key) {
            return is_string($value);
        });

        if (empty($data)) {
            $products = [];
        }else{

                $products = Stock::selectRaw(' products.full_name, products.id as id , sum(stock) as stock, (sum(order_details.sale_price) / count(stock)) as sale_price')
                ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
                ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
                ->productBarcode($request->barcode)
                ->product($request->name)
                ->where('status', true)
                ->groupBy('products.full_name', 'products.id')
                ->get();
        }
        $commerce = Commerce::first();
        return view('quotes.show', compact('order', 'commerce', 'products'));
    }
}
