<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\Resolution;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateResolutionController extends Controller
{

    protected $rules = [
        'serie'       => 'required',
        'from'        => 'required',
        'to'          => 'required',
        'resolution'  => 'required|unique:resolutions,resolution',
        'date'        => 'required|date',
        'commerce_id' => 'required|exists:commerces,id',
    ];
    public function create()
    {
        $commerces = Commerce::pluck('name', 'id')->toArray();
        return view('resolutions.create', compact('commerces'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $resolution = Resolution::create($request->all());
        Alert::success('Se ha agregado correctamente');
        return redirect()->route('resolutions.index');
    }
}
