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

    	Alert::success('Producto editado correctamente');
    	return redirect()->route('products.index');
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
