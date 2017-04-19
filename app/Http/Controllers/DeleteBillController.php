<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Styde\Html\Facades\Alert;

class DeleteBillController extends Controller
{
     public function destroy(Request $request, Order $order)
    {
        DB::beginTransaction();
        $history = StockHistory::where('order_id', $order->id)->get();

        foreach ($history as $item) {
            $stock = Stock::findOrFail($item->stock_id);

            if(!$stock){
                DB::rollback();
                Alert::danger('Upps!! a ocurrido un error...')->details('Intente nuevamente, si persiste el problema comuniquese con soporte al 54606633');
                return redirect()->back();
            }
            $stock->stock = $stock->stock + $item->lot;
            $stock->status = true;
            $stock->save();
        }
        if(!$stock){
            DB::rollback();
            Alert::danger('Upps!! a ocurrido un error...')->details('Intente nuevamente, si persiste el problema comuniquese con soporte al 54606633');
            return redirect()->back();
        }
        $details = Order::destroy($order->id);
        DB::commit();

        Alert::success('Se ha eliminado la factura');
        return redirect('/');
    }
}
