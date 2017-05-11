<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Make;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateMakeController extends Controller
{
    protected $rules = [
        'name' => 'required|unique:makes,name',
        'logo' => 'image'
    ];
    public function create()
    {
    	return view('makes.create');
    }

    public function store(Request $request)
    {

    	$this->validate($request, $this->rules);
    	$make = Make::create($request->all());
    	if ($request->hasFile('logo'))
        {
            $make->logo_path = $request->file('logo')->store('logos');
        }
		$make->save();
    	Alert::success('Marca agregada correctamente');
    	return redirect()->route('makes.index');
    }
}
