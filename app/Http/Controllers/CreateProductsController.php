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

class CreateProductsController extends Controller
{
    public function create()
    {
    	$presentations = ProductPresentation::pluck('name', 'id')->toArray();
    	$groups = ProductGroup::pluck('name', 'id')->toArray();
    	$units  = UnitMeasure::pluck('name', 'id')->toArray();
    	return view('products.create', compact('presentations', 'groups', 'units'));
    }

    public function store(ProductRequest $request)
    {
    	$new = Product::create($request->all());
    	Alert::success('Producto creado correctamente');
    	return redirect('/home');
    }
}
