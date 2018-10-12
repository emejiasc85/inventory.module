<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\StockHistory;
use EmejiasInventory\Http\Resources\InvoiceResource;
use EmejiasInventory\Entities\Order;

class InvoiceDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $invoice = Order::findOrFail(request()->invoice_id);
        $rules  =[
            'product_id' => 'required|exists:products,id|unique:order_details,product_id,NULL,id,order_id,'.request()->invoice_id,
            'lot'        => 'required|numeric|integer|min:1',
            'price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0'
        ];

        $this->validate(request(), $rules);
        $data = array_add(request()->all(), 'order_id', request()->invoice_id);
        $data = array_add($data, 'sale_price', request()->get('price'));
        $data = array_add($data, 'offer_price', request()->get('offer_price'));
        $data = array_add($data, 'purchase_price', request()->get('price'));
        $data = array_add($data, 'total_offer_purchase', request()->get('offer_price') * request()->lot);


        DB::beginTransaction();
            $lot = $request->lot;
            $new_detail = OrderDetail::create($data);
            while ($lot > 0) {
                $inventory = Stock::select('stocks.id')
                    ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
                    ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
                    ->where('products.id', request()->product_id)
                    ->where('status', true)
                    ->first();
                $lot = $this->updateStock($inventory->id, $lot, $new_detail);
            }
            $invoice->sumTotals();
            $invoice->sumOfferTotals();
            $invoice->setFinalTotal();
            $invoice->save();
        DB::commit();

        return new InvoiceResource($invoice->load('details', 'gift_cards', 'bill'));
    }

    public function updateStock($inventory, $lot, $new_detail)
    {
        $inventory = Stock::findOrFail($inventory);
        $history = new StockHistory();
        //si la cantidad pedida es mayor al inventario, restamos, y pasamos el resto al siguiente bucle
        if($lot >  $inventory->stock)
        {
            $out = $lot - $inventory->stock;
            $history->lot = $inventory->stock;
            $inventory->stock = 0;
            $inventory->status = false;
        }
        else{
            $out = 0;
            $inventory->stock = $inventory->stock - $lot;
            if ($inventory->stock == 0) {
              $inventory->status = false;
            }
            $history->lot = $lot;

        }
        $inventory->save();
        //una vez rebajo del inventario creamos el historial de regresion
        $history->order_id = $new_detail->order_id;
        $history->order_detail_id = $new_detail->id;
        $history->stock_id = $inventory->id;
        $history->save();

        return $out;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $invoice_detail)
    {
        $invoice = Order::findOrFail($invoice_detail->order_id);

        DB::beginTransaction();
            $history = StockHistory::where('order_detail_id', $invoice_detail->id)->get();

            foreach ($history as $item) {
                $stock = Stock::findOrFail($item->stock_id);
                if(!$stock){
                    DB::rollback();
                    return redirect()->json(['errors' => ['error' =>['error al eliminar']]], 422);
                }
                $stock->stock = $stock->stock + $item->lot;
                $stock->status = true;
                $stock->save();
            }
            if(!$stock){
                DB::rollback();
                return redirect()->json(['errors' => ['error' =>['error al eliminar']]], 422);
            }

            $invoice_detail->delete();
            $invoice->sumTotals();
            $invoice->sumOfferTotals();
            $invoice->setFinalTotal();

            $invoice->save();
        DB::commit();

        return new InvoiceResource($invoice->load('details', 'gift_cards', 'bill'));
    }
}
