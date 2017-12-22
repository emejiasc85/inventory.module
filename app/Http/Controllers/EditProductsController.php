<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Http\Requests\EditProductRequest;

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

    	Alert::success('Producto editado correctamente');
    	return redirect()->route('products.index');
    }
}
