<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use EmejiasInventory\Http\Requests\CreatePeopleRequest;

class CreatePeopleController extends Controller
{


    public function create()
    {
        return view('people.create');
    }

    public function store(CreatePeopleRequest $request)
    {
        if ($request->hasFile('file'))
        {
            $request->request->add(['avatar' => $request->file('file')->store('people/photos')]);
        }
        $people = People::create($request->all());
        Alert::success('Persona creada correctamente');
        return redirect()->route('people.index');
    }
}
