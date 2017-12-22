<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditProductsController extends Controller
{
    public function rules($id)
    {
        return [
            
        ];
    }
    public function edit(Product $product, $slug)
    {
    	return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, $this->rules($product->id));
    	$product->fill($request->all());
    	$product->save();

    	Alert::success('Producto editado correctamente');
    	return redirect()->route('products.index');
    }
}
