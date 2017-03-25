<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\OrderType;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditOrderTypeController extends Controller
{
    public function edit(OrderType $type)
    {
    	return view('orders.types.edit', compact('type'));
    }

    public function update(Request $request, OrderType $type)
    {
    	$this->validate($request, ['name' => 'required']);

    	$type->fill($request->all());
    	$type->save();
    	Alert::success('Tipo de orden editado correctamente');
    	return redirect()->route('orders.type.index');
    }
}
