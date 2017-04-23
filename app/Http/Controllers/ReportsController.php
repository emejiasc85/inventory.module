<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
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
            //->whereRaw('sum(orders.total) > 51')
            //->sales($request->get('simbol'), $request->get('sales'))
            ->userName($request->name)
            ->groupBy('users.name')
            ->orderBy('totals', 'DESC')
            ->paginate();

        return view('reports.sellers', compact('sellers', 'users'));
    }
}
