<?php

namespace EmejiasInventory\Http\Controllers;

use Carbon\Carbon;
use EmejiasInventory\Entities\Bill;
use EmejiasInventory\Entities\{Order,Commerce,Stock};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use EmejiasInventory\Entities\CashRegister;
use Styde\Html\Facades\Alert;

class BillController extends Controller
{

    public function index(Request $request)
    {


        $open_register= CashRegister::where('status', false)->orderBy('id', 'DESC')->get();
        
        if($open_register->count() == 0){
            Alert::warning('Debe aperturar una caja antes de realizar ventas');
    
            return redirect()->route('cash.registers.create');

        }  
        $register = $open_register->first();

    
        
        $diary_sales = Order::select(DB::raw('DATE(created_at) as date, sum(total) as total'))
            ->where('order_type_id', 2)
            ->where('cash_register_id', $register->id)
            ->whereMonth('created_at', '=', Carbon::today()->format('m'))
            ->groupBy('date')
            ->get();
        $sales_day = Order::where('order_type_id', 2) ->where('cash_register_id', $register->id)->where('credit', false)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();
        $credits_day = Order::where('order_type_id', 2)->where('cash_register_id', $register->id)->where('credit', true)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();
        $sales_month = Order::where('order_type_id', 2) ->where('cash_register_id', $register->id)->whereMonth('created_at', '=', Carbon::today()->format('m'))->get();

        $bills = Order::select('orders.*')->where('order_type_id', 2)
            ->where('cash_register_id', $register->id)
            ->peopleName($request->people_name)
            ->id($request->bill_id)
            ->date($request->from, $request->to)
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return view('bills.index', compact('bills', 'sales_day', 'sales_month', 'diary_sales', 'credits_day', 'register'));
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
            $products = Stock::selectRaw(" CONCAT(products.full_name,' (', makes.name,')') as full_name, products.id as id , sum(stock) as stock, (sum(order_details.sale_price) / count(stock)) as sale_price")
                ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
                ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
                ->leftJoin('makes', 'makes.id', '=', 'products.make_id' )
                ->productBarcode($request->barcode)
                ->product($request->name)
                ->where('status', true)
                ->groupBy('products.full_name', 'products.id', 'makes.name')
                ->get();
        }
        $commerce = Commerce::first();
        return view('bills.show', compact('order', 'commerce', 'products'));
    }
}
