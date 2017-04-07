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
        $this->validate($request, ['provider_id' => 'required']);
        $order->fill($request->all());
        $order->save();
        Alert::success('Pedido editada correctamente');
        return redirect($order->url);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $status = $request->get('status');
        if ($status == 'Solicitado' && count($order->details)==0) {
            Alert::warning('Alerta')->details('Debes ingresar al Menos un producto');
            return redirect()->back();

        }
        if ($status == 'Ingresado' && $order->details->where('total', 0)->count() > 0) {
            Alert::warning('Alerta')->details('Se debe de agregar precios a todos los productos');
            return redirect()->back();
        }

        $this->validate($request, ['status' => 'required']);
        $order->status = $request->get('status');
        $order->save();
        Alert::success('El estado del pedido fue cambiado a: '.$request->get('status'));
        return redirect($order->url);
    }
}
