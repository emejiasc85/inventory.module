<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Warehouse, Commerce};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateWarehouseController extends Controller
{
    public function create()
    {
        $commerces = Commerce::pluck('name', 'id')->toArray();
    	return view('warehouses.create', compact('commerces'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'commerce_id' => 'required']);
    	Warehouse::create($request->all());
    	Alert::success('Bodega agregada correctamente');
    	return redirect()->route('warehouses.index');
    }
}
