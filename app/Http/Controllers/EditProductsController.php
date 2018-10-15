<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Http\Requests\EditProductRequest;
use EmejiasInventory\Entities\OrderDetail;
use Illuminate\Support\Facades\DB;

class EditProductsController extends Controller
{
    public function edit(Product $product, $slug)
    {
    	return view('products.edit', compact('product'));
    }

    public function update(EditProductRequest $request, Product $product)
    {
    	$product->fill($request->all());
        $product->save();
        $product->colors()->sync($request->color);
        $product->full_name = $product->group->name.' '. $product->unit->name.' '. $product->category->name.' '. $product->serie->name.' '.$product->make->name;
        $product->save();

        /* $name=$request->name;
        $val1=substr($name, 0, 1);
        $val2=substr($name,1, 1);
        $val3=substr($name, 2, 2);
        $salida=ord($val1).ord($val2).ord($val3); */
        if ($request->barcode == '') {
            $product->barcode= $this->generateBarcodeNumber($product->id);;

            //$product->barcode=$salida.$product->id;
            $product->save();
        }

    	Alert::success('Producto editado correctamente');
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

    public function updatePrices()
    {
        $orders = OrderDetail::all()->groupBy('product_id');
        DB::transaction(function () use($orders)
        {
            foreach ($orders as $key => $items) {
               $price =  max($items->pluck('sale_price')->toArray());

               $product = Product::findOrFail($key);
               $product->price = $price;
               $product->save();
            }
        });

        Alert::success('Precios Actualizados');
        return redirect('/');
    }
}
