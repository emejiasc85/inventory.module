<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditPeopleController extends Controller
{
    //except,idColumn
     protected $rules = [
        'name'    => 'required',
        'nit'     => 'required|unique:people,nit,except,id',
        'email'   => 'nullable|unique:people,email,except,id',
        'address' => 'required',
        'phone'   => 'nullable',
        'type'    => 'required',
    ];

    public function edit(People $people, $slug)
    {
        return view('people.edit',compact('people'));
    }

    public function update(Request $request, People $people)
    {
        $this->validate($request, $this->rules);
        $people->fill($request->all());
        $people->save();
        Alert::success('Persona editada correctamente');
        return redirect()->route('people.index');
    }
}
