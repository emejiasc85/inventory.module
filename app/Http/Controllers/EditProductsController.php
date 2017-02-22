<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use EmejiasInventory\Http\Requests\ProductRequest;
use Styde\Html\Facades\Alert;

class EditProductsController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function edit(Product $product, $slug)
    {
    	return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
    	$product->fill($request->all());
    	$product->save();

    	Alert::success('Producto editado correctamente');
    	return redirect()->route('products.index');
    }
}
