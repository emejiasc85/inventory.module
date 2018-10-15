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
use EmejiasInventory\Entities\ProductSerie;
use EmejiasInventory\Entities\Category;
use EmejiasInventory\Entities\Make;

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
        $new = new Product();
        $new->product_presentation_id  = $request->product_presentation_id;
        $new->product_group_id  = $request->product_group_id;
        $new->category_id  = $request->category_id;
        $new->product_serie_id  = $request->product_serie_id;
        $new->unit_measure_id  = $request->unit_measure_id;
        $new->make_id  = $request->make_id;
        $new->name          = $request->name;
        $new->description   = $request->description;
        $new->minimum_stock = $request->minimum_stock;
        $new->minimum_stock = $request->minimum_stock;
        $new->price         = $request->price;
        $new->price         = $request->price;
        $new->offer_price   = $request->offer_price;
        $new->save();
        $new->full_name = $new->group->name.' '. $new->unit->name.' '. $new->category->name.' '. $new->serie->name.' '.$new->make->name;
        $new->save();

       /*  $val1=substr($name, 0, 1);
        $val2=substr($name,1, 1);
        $val3=substr($name, 2, 2);
        $salida=ord($val1).ord($val2).ord($val3); */
        if ($request->barcode == '') {
            //$new->barcode=$salida.$new->id;
             $new->barcode= $this->generateBarcodeNumber($new->id);;
            $new->save();
        }

        $new->colors()->sync($request->color);

        if ($request->has('make_order')) {
            $order  = $this->addToOrder($request, $new);
            Alert::success('Producto creado correctamente')->details('Producto ingresado a existencias');
        }
        else{
            Alert::success('Producto creado correctamente');
        }


    	return redirect()->route('products.index');
    }


    function generateBarcodeNumber(int $id) {
        $id = sprintf('%04d', $id);
        $number = mt_rand(100000, 999999).$id; // better than rand()

        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Product::whereBarcode($number)->exists();
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
