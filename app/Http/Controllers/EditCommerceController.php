<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Commerce;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditCommerceController extends Controller
{
	public function edit(Commerce $commerce, $slug)
	{
		return view('commerces.edit', compact('commerce'));
	}

	public function update(Request $request, Commerce $commerce)
	{

		$commerce->fill($request->all());
		$commerce->save();

		Alert::success('Se realizaron los cambios correctamente');
		return redirect()->back();
	}
}
