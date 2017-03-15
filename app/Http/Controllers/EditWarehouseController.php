<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Warehouse;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditWarehouseController extends Controller
{
    public function edit(Warehouse $warehouse, $slug)
    {
    	return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
    	$this->validate($request, ['name' => 'required']);

    	$warehouse->fill($request->all());
    	$warehouse->save();

    	Alert::success('Bodega editada correctamente');

    	return redirect('/home');
    }
}
