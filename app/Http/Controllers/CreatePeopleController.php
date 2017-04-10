<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreatePeopleController extends Controller
{

    protected $rules = [
        'name'    => 'required',
        'nit'     => 'required|unique:people,nit',
        'email'   => 'nullable|unique:people,nit',
        'address' => 'required',
        'phone'   => 'nullable',
        'type'    => 'required',
    ];
    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $new_people = People::create($request->all());
        Alert::success('Persona creada correctamente');
        return redirect('/');
    }
}
