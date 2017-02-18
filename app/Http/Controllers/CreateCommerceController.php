<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Http\Requests\CommerceRequest;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateCommerceController extends Controller
{
    public function create()
    {
    	return view('commerces.create');
    }

    public function store(CommerceRequest $request)
    {
    	$new = Commerce::create($request->all());
    	Alert::success('Comercio creado correctamente.');
    	return redirect('/home');
    }
}
