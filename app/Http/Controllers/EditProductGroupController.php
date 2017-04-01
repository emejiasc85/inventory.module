<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductGroup;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditProductGroupController extends Controller
{

    public function edit(ProductGroup $group, $slug)
    {
    	return view('product_groups.edit', compact('group'));
    }

    public function update(Request $request, ProductGroup $group)
    {
    	$this->validate($request, ['name' => 'required']);

    	$group->fill($request->all());
    	$group->save();

    	Alert::success('Grupo editado correctamente');

    	return redirect()->route('product.groups.index');
    }
}
