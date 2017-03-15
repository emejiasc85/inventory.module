<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Warehouse;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateWarehouseController extends Controller
{
    public function create()
    {
    	return view('warehouses.create');
    }

    public function store(Request $request)
    {
    	Warehouse::create($request->all());
    	Alert::success('Bodega agregada correctamente');
    	return redirect('/home');
    }
}
