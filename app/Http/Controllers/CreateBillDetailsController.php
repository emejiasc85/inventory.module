<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Order,OrderDetail,Stock};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Styde\Html\Facades\Alert;

class CreateBillDetailsController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $rules  =[
            'product_id' => 'required|exists:products,id|unique:order_details,product_id,NULL,id,order_id,'.$order->id,
            'lot'        => 'required|numeric',
            'sale_price' => 'required'
        ];

        $this->validate($request, $rules);
        $data = array_add($request->all(), 'order_id', $order->id);
        $data = array_add($data, 'purchase_price', $request->get('sale_price'));


            DB::beginTransaction();
        try {

        $lot = $request->lot;
            while ($lot > 0) {
                $inventory = Stock::select('stocks.id')
                    ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
                    ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
                    ->where('products.id', $request->product_id)
                    ->where('status', true)
                    ->first();

               if(!isset($inventory)){
                    Alert::danger('Alerta')->details('El pedido excede el inventario');
                    DB::rollBack();
                    return redirect()->back();
               }
                $lot = $this->updateStock($inventory->id, $lot);

            }
            $new_detail = OrderDetail::create($data);
            $order->sumTotals();
            $order->save();

        } catch (Exception $e) {
            Alert::danger('Consulta a soporte Tecnico 54606633');
            DB::rollBack();
        }
            DB::commit();
        return redirect()->back();
    }

    public function updateStock($inventory, $lot)
    {
        $inventory = Stock::findOrFail($inventory);


        if($lot >  $inventory->stock)
        {
            $out = $lot - $inventory->stock;
            $inventory->stock = 0;
            $inventory->status = false;
        }
        else{
            $out = 0;
            $inventory->stock = $inventory->stock - $lot;
            if ($inventory->stock == 0) {
              $inventory->status = false;
            }
        }
        $inventory->save();

        return $out;
    }
}
