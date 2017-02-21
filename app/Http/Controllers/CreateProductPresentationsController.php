<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductPresentation;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateProductPresentationsController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('product_presentations.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, ['name' => 'required']);

    	$new = ProductPresentation::create($request->all());
    	Alert::success('Presentación agregada correctamente');
    	return redirect()->route('product.presentations.index');
    }
}
