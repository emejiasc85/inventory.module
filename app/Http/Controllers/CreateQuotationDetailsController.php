<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Order,OrderDetail};
use Illuminate\Http\Request;

class CreateQuotationDetailsController extends Controller
{
    public function store(Request $request, Order $order )
    {
        $rules  =[
            'product_id' => 'required|exists:products,id|unique:order_details,product_id,NULL,id,order_id,'.$order->id,
            'lot'        => 'required|numeric|integer|min:1',
            'sale_price' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules);
        $data = array_add($request->all(), 'order_id', $order->id);
        $data = array_add($data, 'purchase_price', $request->get('sale_price'));
        $new_detail = OrderDetail::create($data);
        $order->sumTotals();
        $order->save();
        return redirect()->back();

    }
}
