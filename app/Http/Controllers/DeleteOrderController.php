<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Entities\Bill;

class DeleteOrderController extends Controller
{
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        $order = Order::findOrFail($request->order_id);
        if(!$order->canRevert()){
            DB::rollback();
            Alert::danger('¡Lo sentimos!')->details('El pedido que intentas eliminar cuenta con productos facturados');
            return redirect()->back();
        }

        $order->delete();
        if(!$order){
            DB::rollback();
            Alert::danger('Upps!! a ocurrido un error...')->details('Intente nuevamente, si persiste el problema comuniquese con soporte al 54606633');
            return redirect()->back();
        }

        DB::commit();

        Alert::success('Se ha eliminado el pedido');
        return redirect()->back();
    }
}
