<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Make;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateMakeController extends Controller
{
    public function create()
    {
    	return view('makes.create');
    }

    public function store(Request $request)
    {

    	$this->validate($request, ['name' => 'required', 'logo' => 'image']);
    	$new = Make::create($request->all());
    	Alert::success('Marca agregada correctamente');
    	return redirect('/home');
    }
}
