<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\{Commerce, OrderType, User};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateOrderController extends Controller
{
   	public function create()
   	{
   		$commerce = Commerce::first();
   		$providers = User::pluck('name', 'id')->toArray();
   		$types = OrderType::pluck('name', 'id')->toArray();
   		return view('orders.create', compact('commerce', 'types', 'providers'));
   	}

   	public function store(Request $request)
   	{
         $this->validate($request, ['provider_id' => 'required']);
   		$data = array_add($request->all(), 'user_id', auth()->user()->id);
   		$new_order = Order::create($data);
   		Alert::success('Orden Creada')->details('Agrega los detalles');
   		return redirect()->route('orders.details.create', $new_order);
   	}
}
