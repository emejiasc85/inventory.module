<?php

namespace EmejiasInventory\Http\Controllers;

use Illuminate\Http\Request;
use EmejiasInventory\Entities\{Payment, Order};
use Styde\Html\Facades\Alert;
use EmejiasInventory\Entities\CashRegister;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $register = CashRegister::orderBy('id', 'DESC')->first()->id;
        $order = Order::findOrFail($request->order_id);
        $this->validate($request, ['amount' => 'required|numeric' ]);
        $request->request->add(['cash_register_id'=> $register]);
        $new = Payment::create($request->all());
        $payments = $order->payments->sum('amount');
        
        if ($payments == $order->total) {
            $order->credit  = false;
            $order->save();
            Alert::success('Pago Agregado correctamente')->details('Factura cancelada');
        }
        return redirect()->back();
    }

   
    public function show(Payment $payment)
    {
        //
    }

   
    public function edit(Payment $payment)
    {
        //
    }

   
    public function update(Request $request, Payment $payment)
    {
        //
    }


    public function destroy(Request $request)
    {
        $payment = Payment::findOrFail($request->payment_id);

        $payment->delete();
        Alert::success('Pago Elimiando correctamente');
        return redirect()->back();

    }
}
