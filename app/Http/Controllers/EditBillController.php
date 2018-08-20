<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Bill;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\Resolution;
use EmejiasInventory\Entities\Payment;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditBillController extends Controller
{
    public function confirm(Request $request, Order $order)
    {
        //verificar esto cuando sean dos o mas tipos de pagos
        if ($request->payment_method_id == 4 && $order->total > $order->people->restCredit) {
            Alert::danger('El consumo de productos excede el credito restante del cliente');
            return redirect()->back();
        }

        $this->setBillNumber($request, $order);
        $this->addPayments($request, $order);
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

    public function setBillNumber(Request $request, Order $order)
    {
        if(trim($request->bill_number) != null){
            if (Resolution::where('status', true)->first()) {

                $resolution = Resolution::where('status', true)->first();

                $request->validate([
                    'bill_number' => 'nullable|integer|unique:bills,bill|max:'.$resolution->to
                ]);

                if ($order->bill) {
                    $bill = Bill::findOrFail($order->bill->id);
                    $bill->status = false;
                    $bill->save();

                    $bill = new Bill();
                    $bill->order_id = $order->id;
                    $bill->resolution_id = $resolution->id;
                    $bill->bill = $request->bill_number;
                    $bill->save();
                }
                else {
                    $bill = new Bill();
                    $bill->order_id = $order->id;
                    $bill->resolution_id = $resolution->id;
                    $bill->bill = $request->bill_number;
                    $bill->save();
                }

                return $bill;
            }

        }

        return null;
    }

    public function addPayments(Request $request, Order $order)
    {
        if($request->has('payment_method_id')){

            if($request->payment_method_id == 4){
                $order->credit = true;
            }

            if ($order->payments->count() > 0) {
                $payment = $order->payments->first();
                $payment->payment_method_id = $request->payment_method_id;
                $payment->amount = $order->total;
                $payment->voucher = $request->voucher;
                $payment->save();
            }

            if($order->payments->count() == 0){
                $payment = Payment::create([
                    'order_id'          => $order->id,
                    'voucher'           => $request->voucher,
                    'amount'            => $order->total,
                    'cash_register_id'  => $order->cash_register_id,
                    'payment_method_id' => $request->payment_method_id
                ]);
            }

            return $payment;

        }

        return null;


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
