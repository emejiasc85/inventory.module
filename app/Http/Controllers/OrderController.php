<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
    	$orders = Order::id($request->get('id'))->orderBy('id', 'DESC')->paginate();
    	return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
    	return view('orders.show', compact('order'));
    }
}
