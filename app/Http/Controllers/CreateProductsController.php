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

    function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
    	return view('products.create');
    }

    public function store(ProductRequest $request)
    {
    	$new = Product::create($request->all());
    	Alert::success('Producto creado correctamente');
    	return redirect('/home');
    }
}
