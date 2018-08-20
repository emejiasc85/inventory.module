<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{
	ProductPresentation,
	ProductGroup,
	UnitMeasure,
	Product
};
use EmejiasInventory\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Entities\People;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Stock;

class CreateProductsController extends Controller
{

    public function create()
    {
        $providers = People::where('type', 'provider')->pluck('name', 'id')->toArray();
    	return view('products.create', compact('providers'));
    }

    public function store(ProductRequest $request)
    {


        $name=$request->input('name');
        $val1=substr($name, 0, 1);
        $val2=substr($name,1, 1);
        $val3=substr($name, 2, 2);
        $salida=ord($val1).ord($val2).ord($val3);
        $new = Product::create($request->all());
        if ($request->barcode == '') {
            $new->barcode=$salida.$new->id;
            $new->save();
        }

        if ($request->has('make_order')) {
            $order  = $this->addToOrder($request, $new);
            Alert::success('Producto creado correctamente')->details('Producto ingresado a existencias');
        }
        else{
            Alert::success('Producto creado correctamente');
        }

    	return redirect()->route('products.index');
    }

    public function addToOrder(Request $request, Product $product)
    {
        $request->request->add([
            'user_id' => auth()->user()->id,
            'priority' => 'Baja',
            'order_type_id' => 1,
            'commerce_id' => 1
        ]);

        //create order
        $order = Order::create($request->all());
        //create detail
        $detail = new OrderDetail();
        $detail->order_id = $order->id;
        $detail->product_id = $product->id;
        $detail->lot = $request->lot;
        $detail->purchase_price = $request->purchase_price;
        $detail->due_date = $request->due_date;
        $detail->sale_price = $request->price;
        $detail->save();
        //update order
        $order->sumTotals();
        $order->status = 'Ingresado';
        $order->save();

        //create stocks
        foreach ($order->details as $detail) {
            Stock::create([
                'stock'     => $detail->lot,
                'warehouse_id' => 1,
                'order_detail_id' => $detail->id
            ]);
        }

        return $order;

    }
}
