<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Styde\Html\Facades\Alert;

class EditOrderDetailsController extends Controller {
    protected $rules = [
<<<<<<< HEAD
        'id' => 'required|exists:order_details,id',
        'lot' => 'required|numeric',
        'purchase_price' => 'numeric|nullable',
        'due_date' => 'date|nullable',
    ];
    public function update(Request $request, Order $order) {
        //$this->validate($request, $this->rules);
        $input = Input::all();
        $condition = $input['id'];
        $allOrders = array(); // make an array, for storing all detail order in it
=======
        'id'             => 'required|exists:order_details,id',
        'lot'            => 'required|numeric',
        'purchase_price' => 'numeric|nullable',
        'due_date'       => 'date|nullable'
    ];
    public function update(Request $request, Order $order)
    {
        //$this->validate($request, $this->rules);
        $input = Input::all();
        $condition = $input['id'];
        $allOrders=array(); // make an array, for storing all detail order in it
>>>>>>> refs/remotes/origin/master
        foreach ($condition as $key => $condition) {
            $detail = OrderDetail::findOrFail($input['id'][$key]);
            $detail->lot = $input['lot'][$key];
            $detail->purchase_price = $input['purchase_price'][$key];
<<<<<<< HEAD
            $detail->due_date = $input['due_date'][$key];
=======
>>>>>>> refs/remotes/origin/master
            $detail->sale_price = $input['sale_price'][$key];
            $detail->save();
        }
        $order->sumTotals();
        $order->save();
        Alert::success('Detalles de pedido editados correctamente');
        return redirect()->back();
    }
}
