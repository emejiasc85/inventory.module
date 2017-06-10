<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Styde\Html\Facades\Alert;

class DeleteQuotationController extends Controller
{
     public function destroy(Request $request, Order $order)
    {
        DB::beginTransaction();

        $destroy = Order::destroy($order->id);
        if(!$destroy){
            DB::rollback();
            Alert::danger('Upps!! a ocurrido un error...')->details('Intente nuevamente, si persiste el problema comuniquese con soporte al 54606633');
            return redirect()->back();
        }
        DB::commit();

        Alert::success('Se ha eliminado la cotización');
        return redirect()->route('quotes.index');
    }
}
