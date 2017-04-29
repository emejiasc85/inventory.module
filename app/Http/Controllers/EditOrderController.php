<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\{Commerce,Order, People, OrderType, Stock};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditOrderController extends Controller
{
    public function edit(Order $order)
    {
    	$commerce = Commerce::first();
   		$providers = People::where('type', 'provider')->pluck('name', 'id')->toArray();
   		$types = OrderType::pluck('name', 'id')->toArray();
   		return view('orders.edit', compact('commerce', 'types', 'providers', 'order'));
    }
    public function update(Request $request,Order $order)
    {
        $this->validate($request, ['people_id' => 'required']);
        $order->fill($request->all());
        $order->save();
        Alert::success('Pedido editada correctamente');
        return redirect($order->url);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $status = $request->get('status');
        if ($status === 'Revertir') {
            $this->reverse($order);
            //return redirect()->back();
        }
        if ($status == 'Solicitado' && count($order->details)==0) {
            Alert::warning('Alerta')->details('Debes ingresar al Menos un producto');
            return redirect()->back();

        }
        if ($status == 'Ingresado' && $order->details->where('total_purchase', 0)->count() > 0) {
            Alert::warning('Alerta')->details('Se debe de agregar precios de compra a todos los productos');
            return redirect()->back();
        }
        if ($status == 'Ingresado' && $order->details->where('sale_price', 0)->count() > 0) {
            Alert::warning('Alerta')->details('Se debe de agregar precios de venta a todos los productos');
            return redirect()->back();
        }

        $low_cost = OrderDetail::where('order_id', $order->id)->whereRaw('sale_price < purchase_price')->count();

        if ($status == 'Ingresado' && $low_cost > 0) {
            Alert::danger('Precio Bajo Costo')->details('El precio de venta de un producto no puede ser menor al precio de compra');
            return redirect()->back();
        }

        $this->validate($request, ['status' => 'required']);
        $order->status = $request->get('status');
        $order->save();

        if ($status == 'Ingresado') {
            foreach ($order->details as $detail) {
                Stock::create([
                    'stock'     => $detail->lot,
                    'warehouse_id' => 1,
                    'order_detail_id' => $detail->id
                ]);
            }
            Alert::success('El Pedido fue ingresado al inventario correctamente');
            return redirect($order->url);
        }
        else{
            Alert::success('El estado del pedido fue cambiado a: '.$request->get('status'));
            return redirect($order->url);

        }

    }

    public function reverse(Order $order)
    {
        if(!$order->canRevert()){
            Alert::danger('¡Lo sentimos!')->details('El pedido que intentas revertir cuenta con productos facturados');
            return redirect()->back();
        }
        $order->status = 'Solicitado';
        $order->save();

        foreach ($order->details as $detail) {
           Stock::where('order_detail_id', $detail->id)->delete();
        }
        Alert::warning('Pedido Revertido');
        return redirect()->back();


    }
}
