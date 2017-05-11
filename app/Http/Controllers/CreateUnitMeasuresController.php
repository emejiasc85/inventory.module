<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\UnitMeasure;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateUnitMeasuresController extends Controller
{
    public function create()
    {
    	return view('unit_measures.create');
    }

    public function store(Request $request)
    {

    	$this->validate($request, ['name' => 'required|unique:unit_measures,name']);
    	$make = UnitMeasure::create($request->all());

    	Alert::success('Unidad agregada correctamente');
    	return redirect()->route('unit.measures.index');
    }
}
