<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Http\Requests\CommerceRequest;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditCommerceController extends Controller
{


    public function edit(Commerce $commerce, $slug)
    {
        return view('commerces.edit', compact('commerce'));
    }

    public function update(CommerceRequest $request, Commerce $commerce)
    {

        $commerce->fill($request->all());
        if ($request->hasFile('logo'))
        {
            $commerce->logo_path = $request->file('logo')->store('logos');
        }

        if ($request->hasFile('gift_card'))
        {
            $commerce->gift_card_path = $request->file('gift_card')->store('cards');
        }
        $commerce->save();

        Alert::success('Se realizaron los cambios correctamente');
        return redirect()->back();
    }
}
