<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Bill;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Resolution;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditBillController extends Controller
{
    public function confirm(Request $request, Order $order)
    {
        if ($request->payment_method_id == 4 && $order->total > $order->people->restCredit) {
            Alert::danger('El consumo de productos excede el credito restante del cliente');
            return redirect()->back();
        }

        if(trim($request->bill_number) != null){
            if (Resolution::where('status', true)->first()) {
                $bill = new Bill();
                $bill->order_id = $order->id;
                $bill->resolution_id = Resolution::where('status', true)->first()->id;
                $bill->bill = $request->bill_number;
                $bill->save();
            }
        }


        if($request->has('payment_method_id')){
            $order->payment_method_id = $request->payment_method_id;

            if($request->payment_method_id == 4){
                $order->voucher = $request->voucher;
            }

            if($request->payment_method_id == 2 || $request->payment_method_id == 3){
                $order->voucher = $request->voucher;
            }

        }

        $order->status = 'Ingresado';
        $order->save();

        if ($order->order_type_id == 4) {
            $message = 'Cotización Finalizada';
        }
        elseif ($order->order_type_id == 2) {
            $message = 'Compra Finalizada';
        }

        return redirect()->back();
    }

    public function revert(Request $request, Order $order)
    {
        $order->status = 'Creado';
        $order->save();
        if ($order->order_type_id == 4) {
            $message = 'Cotización Revertida';
        }
        elseif ($order->order_type_id == 2) {
            $message = 'Compra Revertida';
        }
        Alert::success($message);
        return redirect()->back();
    }
}
