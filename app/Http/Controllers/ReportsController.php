<?php

namespace EmejiasInventory\Http\Controllers;

use Carbon\Carbon;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function sellers(Request $request)
    {
        $users = User::pluck('name', 'id')->toArray();
        $sellers = Order::selectRaw('users.name, count(orders.id) as sales, sum(orders.total) as totals')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->where('order_type_id', 2)
            ->date($request->from, $request->to)
            //->sales($request->get('simbol'), $request->get('sales'))
            ->userName($request->name)
            ->groupBy('users.name')
            ->orderBy('totals', ($request->order == null ? 'DESC': $request->order))
            ->paginate();
        return view('reports.sellers', compact('sellers', 'users'));
    }

    public function products(Request $request)
    {
        $products = OrderDetail::selectRaw('products.id, products.name, sum(order_details.lot) as cant')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->whereRaw('orders.order_type_id =2')
            ->productName($request->name)
            ->date($request->from, $request->to)
            ->groupBy('products.id', 'products.name')
            ->orderBy('cant', ($request->order == null ? 'DESC': $request->order))
            ->paginate();
        return view('reports.products', compact('products'));
    }

    public function dueDate(Request $request)
    {

        $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)
            ->where('due_date', '!=', null)
            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->dueDate(Carbon::now(), Carbon::now()->addMonths(8))
            ->stock($request->get('simbol'), $request->get('stock'))
            ->where('status', true)
            ->OrderBy('due_date', 'ASC')
            ->get();


        return view('stocks.due_date', compact('stocks'));
    }

    public function minStock(Request $request)
    {
        $stocks = Stock::leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('warehouse_id', 1)

            ->order($request->get('order_id'))
            ->product($request->get('name'))
            ->productId($request->get('id'))
            ->stock('<=', 5)
            ->where('status', true)
            ->OrderBy('due_date', 'ASC')
            ->get();

        return view('stocks.min_stock', compact('stocks'));
    }

    public function resumen(Request $request)
    {
        $orders = Order::where('status', 'Ingresado')->where('order_type_id', 1)->orWhere('order_type_id', 2)->paginate();
        return view('reports.resumen', compact('orders'));
    }
}
