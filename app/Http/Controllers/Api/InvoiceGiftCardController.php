<?php

namespace EmejiasInventory\Http\Controllers\api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Http\Requests\InvoiceGiftCardStore;
use EmejiasInventory\Entities\GiftCard;
use EmejiasInventory\Http\Resources\InvoiceResource;
use EmejiasInventory\Entities\Order;

class InvoiceGiftCardController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceGiftCardStore $request, Order $invoice)
    {
        $gift_card = GiftCard::findOrFail(request()->gift_card_id);
        $invoice->gift_cards()->attach(request()->gift_card_id);
        $invoice->sumTotals();
        $invoice->sumOfferTotals();

        $invoice->save();

        $gift_card->status = true;
        $gift_card->save();

        return new InvoiceResource($invoice);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $invoice)
    {
        $invoice->gift_cards()->detach(request()->gift_card_id);

        $gift_card = GiftCard::findOrFail(request()->gift_card_id);
        $gift_card->status = false;
        $gift_card->save();

        $invoice->sumTotals();
        $invoice->sumOfferTotals();

        $invoice->save();

        return new InvoiceResource($invoice);
    }
}
