<?php

namespace EmejiasInventory\Http\Controllers;

use Carbon\Carbon;
use EmejiasInventory\Entities\Bill;
use EmejiasInventory\Entities\{Order,Commerce,Stock};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{

    public function index()
    {
        $diary_sales = Order::select(DB::raw('DATE(created_at) as date, sum(total) as total'))
            ->where('order_type_id', 2)
            ->whereMonth('created_at', '=', Carbon::today()->format('m'))
            ->groupBy('date')
            ->get();
        $sales_day = Order::where('order_type_id', 2)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();
        $sales_month = Order::where('order_type_id', 2)->whereMonth('created_at', '=', Carbon::today()->format('m'))->get();
        $bills = Order::where('order_type_id', 2)->orderBy('created_at', 'DESC')->paginate();
        return view('bills.index', compact('bills', 'sales_day', 'sales_month', 'diary_sales'));
    }
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
