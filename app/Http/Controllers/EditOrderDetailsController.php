<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Styde\Html\Facades\Alert;

class EditOrderDetailsController extends Controller
{
    protected $rules = [
        'id'             => 'required|exists:order_details,id',
        'lot'            => 'required|numeric|integer|min:1',
        'purchase_price' => 'numeric|nullable|min:1',
        'sale_price'     => 'numeric|nullable|min:1',
        'due_date'       => 'date|nullable'
    ];
    public function update(Request $request, Order $order)
    {
        $input = Input::all();
        $condition = $input['id'];
        $allOrders=array(); // make an array, for storing all detail order in it
        foreach ($condition as $key => $condition) {

        $validation=[
            'id'            =>$input['id'][$key],
            'lot'            =>$input['lot'][$key],
            'purchase_price' =>$input['purchase_price'][$key],
            'sale_price'     =>$input['sale_price'][$key],
        ];

        //dd($input);
            $detail    = OrderDetail::findOrFail($input['id'][$key]);
            $validator = Validator::make($validation, $this->rules);
            if ($validator->fails())
            {

                $validator->errors()->add('', 'Se Encuentra en el producto '.$detail->product->name);
                return redirect()->back()->withErrors($validator);
            }
            $detail->lot = $input['lot'][$key];
            $detail->purchase_price = $input['purchase_price'][$key];
            $detail->due_date = $input['due_date'][$key];
            $detail->sale_price = $input['sale_price'][$key];
            $detail->save();
        }
        $order->sumTotals();
        $order->save();
        Alert::success('Detalles de pedido editados correctamente');
        return redirect()->back();
    }
}
