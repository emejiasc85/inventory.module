<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->id()
            ->date()
            ->status($request->get('status'))
            ->priority($request->get('priority'))
            ->total($request->get('simbol'), $request->get('total'))
            ->where('order_type_id', 1)
            ->orderBy('id', 'DESC')
            ->paginate();
    	return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
    	return view('orders.show', compact('order'));
    }
}
