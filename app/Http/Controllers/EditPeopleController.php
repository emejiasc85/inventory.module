<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Color;
use EmejiasInventory\Entities\People;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditPeopleController extends Controller
{
    //except,idColumn


    public function edit(People $people, $slug)
    {
        return view('people.edit',compact('people'));
    }

    public function update(Request $request, People $people)
    {
        $rules = [
            'name'        => 'required',
            'nit'         => 'required|unique:people,nit,'.$people->id,
            'email'       => 'nullable|unique:people,email,'.$people->id,
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

        $this->validate($request, $rules);
        if ($request->hasFile('file'))
        {
            $request->request->add(['avatar' => $request->file('file')->store('people/photos')]);
        }
        $people->fill($request->all());
        $people->save();
        Alert::success('Persona editada correctamente');
        return redirect($people->profileUrl);
    }

    public function editColors(People $people)
    {
        $colors = Color::all();
        return view('people.colors', compact('people', 'colors'));
    }

    public function updateColors(Request $request, People $people)
    {
        $people->colors()->sync($request->color);
        Alert::success('Colores editados');
        return redirect($people->profileUrl);
    }
}
