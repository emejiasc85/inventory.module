<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductPresentation;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class EditProductPresentationsController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function edit(ProductPresentation $presentation, $slug)
    {
    	return view('product_presentations.edit', compact('presentation'));
    }

    public function update(Request $request, ProductPresentation $presentation)
    {

    	$this->validate($request, ['name' => 'required']);

    	$presentation->fill($request->all());
    	$presentation->save();

    	Alert::success('Presentación editada correctamente');

    	return redirect('/home');
    }
}
