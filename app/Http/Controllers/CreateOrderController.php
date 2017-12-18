<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\{Commerce, OrderType, User, People};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateOrderController extends Controller
{
   	public function create()
   	{
         $commerce  = Commerce::first();
         $providers = People::where('type', 'provider')->pluck('name', 'id')->toArray();
         $types     = OrderType::pluck('name', 'id')->toArray();
   		return view('orders.create', compact('commerce', 'types', 'providers'));
   	}

   	public function store(Request $request)
   	{
        $this->validate($request, ['people_id' => 'required', 'order_type_id' => 'required']);
   		$data = array_add($request->all(), 'user_id', auth()->user()->id);
   		$new_order = Order::create($data);
   		Alert::success('Pedido Creado')->details('Agrega los detalles');
   		return redirect()->route('orders.details.create', $new_order);
   	}
}
