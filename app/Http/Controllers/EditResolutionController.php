<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\Resolution;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditResolutionController extends Controller
{
     protected $rules = [
        'serie'       => 'required',
        'from'        => 'required',
        'to'          => 'required',
        'resolution'  => 'required',
        'date'        => 'required|date',
        'commerce_id' => 'required|exists:commerces,id',
    ];
    public function edit(Resolution $resolution)
    {
        $commerces = Commerce::pluck('name', 'id')->toArray();
        return view('resolutions.edit', compact('resolution', 'commerces'));
    }

    public function update(Request $request, Resolution $resolution)
    {
        $this->validate($request, $this->rules);

        $resolution->fill($request->all());
        $resolution->save();

        Alert::success('Resolución editada correctamente');

        return redirect()->route('resolutions.index');
    }
}
