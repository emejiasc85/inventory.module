<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Order as Invoice;
use EmejiasInventory\Http\Resources\InvoiceResource;

class InvoiceRevertController extends Controller
{
    public function update(Invoice $invoice)
    {
        $invoice->status = 'Creado';
        $invoice->save();

        return new InvoiceResource($invoice->load('details', 'gift_cards', 'bill'));
    }
}
