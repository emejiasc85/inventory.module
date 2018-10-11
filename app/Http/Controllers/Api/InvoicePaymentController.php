<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Order as Invoice;
use EmejiasInventory\Http\Resources\InvoiceResource;
use EmejiasInventory\Entities\Payment;
use EmejiasInventory\Http\Requests\InvoicePaymentUpdate;

class InvoicePaymentController extends Controller
{
    public function update(InvoicePaymentUpdate $request, Invoice $invoice)
    {
        request()->credit > 0 ? $invoice->credit = true: '';
        $invoice->addPayment(1, request()->cash);
        $invoice->addPayment(2, request()->card, request()->card_voucher);
        $invoice->addPayment(3, request()->check, request()->check_voucher);
        $invoice->addPayment(4, request()->credit);
        $invoice->addPayment(5, request()->gift_card, request()->gift_card_code);
        $invoice->addBillNumber();

        $invoice->status = 'Ingresado';
        $invoice->save();
        return new InvoiceResource($invoice->load('details', 'gift_cards', 'bill'));
    }
}
