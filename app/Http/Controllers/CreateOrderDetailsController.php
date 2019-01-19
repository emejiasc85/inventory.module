<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Order, Product, OrderDetail};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateOrderDetailsController extends Controller
{

   public function create(Request $request, Order $order)
   {
      $data = $request->all();
      $data = array_where($data, function ($value, $key) {
          return is_string($value);
      });

      if (empty($data)) {
        $products = [];
      }else{
         $products = Product::query()
          ->name()
          ->id()
          ->makes()
      		->presentation()
      		->barcode()
      		->unit()
      		->groups()
      		->orderBy('id', 'DESC')
      		->get();

      }
   		return view('orders.details.create', compact('order', 'products'));
   }

   public function store(Request $request, Order $order)
   {
      $rules  =[
        'product_id'     => 'required|exists:products,id|unique:order_details,product_id,NULL,id,order_id,'.$order->id,
        'lot'            => 'required|numeric|integer|min:1',
        'purchase_price' => 'nullable|numeric|min:0'
      ];
      $this->validate($request, $rules);
      $data = array_add($request->all(), 'order_id', $order->id);
   		$new_detail = OrderDetail::create($data);
      $order->sumTotals();
      $order->save();
   		Alert::success('Producto Agregado correctamente');
   		return redirect($order->url);
   }
}
