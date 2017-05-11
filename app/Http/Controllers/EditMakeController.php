<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Make;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditMakeController extends Controller
{
    public function rules($id)
    {
        return [
            'name' => 'required|unique:makes,name,'.$id,
            'logo' => 'image'
        ];
    }
    public function edit(Make $make, $slug)
    {
    	return view('makes.edit', compact('make'));
    }

    public function update(Request $request,  Make $make)
    {
    	$this->validate($request, $this->rules($make->id));

    	$make->fill($request->all());
    	if ($request->hasFile('logo'))
        {
            $make->logo_path = $request->file('logo')->store('logos');
        }
		$make->save();
    	Alert::success('Marca editada correctamente');
        return redirect()->route('makes.index');
    }
}
