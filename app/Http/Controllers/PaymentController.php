<?php

namespace EmejiasInventory\Http\Controllers;

use Illuminate\Http\Request;
use EmejiasInventory\Entities\{Payment, Order};
use Styde\Html\Facades\Alert;
use EmejiasInventory\Entities\CashRegister;

class PaymentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('deposit'))
        {
            $request->request->add(['payment_method_id' => 7]);
        }
        else
        {
            $request->request->add(['payment_method_id' => 6]);
        }

        $register = CashRegister::orderBy('id', 'DESC')->first()->id;
        $order = Order::findOrFail($request->order_id);
        $this->validate($request, ['amount' => 'required|numeric' ]);
        $request->request->add(['cash_register_id'=> $register]);

        $payments = $order->payments->where('payment_method_id', 6)->sum('amount') + $request->amount;
        $credit = $order->payments->where('payment_method_id', 4)->sum('amount');

        if ($payments > $credit)
        {
            Alert::danger('Alerta')->details('No se pudo realizar el abono a credito')->items(['El pago excede el monto de acreditado']);
            return redirect()->back();
        }

        $new = Payment::create($request->all());
        $payments = $order->payments->where('payment_method_id', 6)->sum('amount');

        if ($payments == $credit) {
            $order->credit  = false;
            $order->save();
            Alert::success('Pago Agregado correctamente')->details('Factura cancelada');
        }
        return redirect()->back();
    }



    public function destroy(Request $request)
    {
        $payment = Payment::findOrFail($request->payment_id);

        $payment->delete();
        Alert::success('Pago Elimiando correctamente');
        return redirect()->back();

    }
}
