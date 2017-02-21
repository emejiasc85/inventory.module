<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\UnitMeasure;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditUnitMeasuresController extends Controller
{
	public function edit(UnitMeasure $unit, $slug)
    {
    	return view('unit_measures.edit', compact('unit'));
    }

    public function update(Request $request,  UnitMeasure $unit)
    {
    	$this->validate($request, ['name' => 'required']);

    	$unit->fill($request->all());

		$unit->save();
    	Alert::success('Unidad editada correctamente');
        return redirect('/home');
    }
}
