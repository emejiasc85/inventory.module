<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\CashRegister;
use EmejiasInventory\Http\Requests\InvoiceStore;
use EmejiasInventory\Entities\Order as Invoice;
use EmejiasInventory\Http\Resources\InvoiceResource;
use Illuminate\Support\Facades\DB;
use EmejiasInventory\Entities\StockHistory;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\Bill;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->cashRegisterId()
            //->peopleName()
            ->id()
            ->date()
            ->credit()
            ->orderBy('created_at', 'DESC')
            ->with('people', 'user')->orderByDesc('id')->paginateIf();

        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStore $request)
    {
         $invoice = new Invoice();
         $invoice->order_type_id = 2;
         $invoice->cash_register_id = request()->cash_register_id;
         $invoice->people_id = request()->people_id;
         $invoice->user_id = auth()->user()->id;
         $invoice->status = 'Creado';
         $invoice->save();
         $invoice->load(['user', 'people', 'cash_register', 'bill.resolution', 'details', 'gift_cards']);

         return new InvoiceResource($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice->load('details', 'gift_cards', 'bill', 'cash_register'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {

        //pasar esto al modelo
        DB::beginTransaction();
            $history = StockHistory::where('order_id', $invoice->id)->get();
            if(isset($history)){
                foreach ($history as $item) {

                    //refactoppaurizar esto como se hizo en inbox bill abajo
                    $stock = Stock::findOrFail($item->stock_id);

                    if(!$stock){
                        DB::rollback();
                        return response(['errors' => ['on_destroy' => ['Intente nuevamente, si persiste el problema comuniquese con soporte']]], 422);
                    }
                    $stock->stock = $stock->stock + $item->lot;
                    $stock->status = true;
                    $stock->save();
                }
            }

            $invoice->bill ? $invoice->bill()->update(['status' => false]) : '';
            $invoice->payments()->delete();
            $invoice->delete();
        DB::commit();
        return response([], 204);

    }
}
