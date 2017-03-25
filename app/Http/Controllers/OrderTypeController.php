<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\OrderType;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function index(Request $request)
    {
    	$types = OrderType::name($request->get('name'))->orderBy('id', 'DESC')->paginate();
    	return view('orders.types.index', compact('types'));
    }
}
