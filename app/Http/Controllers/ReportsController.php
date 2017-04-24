<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
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
}
