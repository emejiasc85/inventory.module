<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Order as Invoice;
use EmejiasInventory\Http\Resources\InvoiceResource;
use EmejiasInventory\Entities\Payment;
use EmejiasInventory\Entities\CashRegister;
use EmejiasInventory\Http\Requests\InvoicePaymentUpdate;
use EmejiasInventory\Http\Requests\CreditInvoicePaymentUpdate;

class CreditInvoicePaymentController extends Controller
{
    public function update(CreditInvoicePaymentUpdate $request, Invoice $invoice)
    {

        $payments = $invoice->payments->whereIn('payment_method_id', [6,7])->sum('amount') + request()->amount;
        $credit = $invoice->payments->where('payment_method_id', 4)->sum('amount');

        if ($payments > $credit)
        {
            return response()->json(['errors' => ['failed' => ['El pago excede el monto acreditado']]], 422);
        }

        $register = CashRegister::orderBy('id', 'DESC')->first()->id;
        request()->merge(['cash_register_id' => $register, 'order_id' => $invoice->id]);

        if ($request->has('deposit'))
        {
            request()->merge(['payment_method_id' => 7]);
        }
        else
        {
            request()->merge(['payment_method_id' => 6]);
        }


        $new = Payment::create($request->all());
        $payments = $invoice->payments->whereIn('payment_method_id', [6,7])->sum('amount');

        if ($payments == $credit) {
            $invoice->credit  = false;
            $invoice->save();
        }

        return new InvoiceResource($invoice->load('details', 'gift_cards', 'bill'));
    }
}
