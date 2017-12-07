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
            'name'                      => 'required',
            'description'               => 'required',
            'minimum_stock'             => 'numeric',
            'product_presentation_id'   => 'required|exists:product_presentations,id',
            'product_group_id'          => 'required|exists:product_groups,id',
            'unit_measure_id'           => 'required|exists:unit_measures,id',
            'make_id'                   => 'required|exists:makes,id',
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
