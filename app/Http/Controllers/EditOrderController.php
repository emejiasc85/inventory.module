<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Commerce,Order, User, OrderType};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditOrderController extends Controller
{
    public function edit(Order $order)
    {
    	$commerce = Commerce::first();
   		$providers = User::pluck('name', 'id')->toArray();
   		$types = OrderType::pluck('name', 'id')->toArray();
   		return view('orders.edit', compact('commerce', 'types', 'providers', 'order'));
    }
    public function update(Request $request,Order $order)
    {
        $this->validate($request, ['provider_id' => 'required', 'order_type_id' => 'required']);
        $order->fill($request->all());
        $order->save();
        Alert::success('Orden editada correctamente');
        return redirect('/home');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $this->validate($request, ['status' => 'required']);
        $order->status = $request->get('status');
        $order->save();
        Alert::success('El estado de la orden fue cambiado a: '.$request->get('status'));
        return redirect($order->url);
    }
}
