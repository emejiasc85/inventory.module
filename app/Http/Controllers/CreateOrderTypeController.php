<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\OrderType;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateOrderTypeController extends Controller
{
    public function create()
    {
    	return view('orders.types.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, ['name' => 'required']);
    	OrderType::create($request->all());
    	Alert::success('Tipo de orden creada correctamente');
        return redirect()->route('orders.type.index');
    }
}
