<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreatePeopleController extends Controller
{

    protected $rules = [
        'name'        => 'required',
        'nit'         => 'required|unique:people,nit',
        'email'       => 'nullable|unique:people,nit',
        'address'     => 'required',
        'phone'       => 'nullable',
        'type'        => 'required',
        'birthday'    => 'nullable|date',
        'gender'      => 'nullable',
        'facebook'    => 'nullable',
        'instagram'   => 'nullable',
        'website'     => 'nullable|url',
        'other_phone' => 'nullable',
        'avatar'      => 'nullable',
    ];
    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        if ($request->hasFile('file'))
        {
            $request->request->add(['avatar' => $request->file('file')->store('people/photos')]);
        }
        $people = People::create($request->all());
        Alert::success('Persona creada correctamente');
        return redirect($people->profileUrl);
    }
}
