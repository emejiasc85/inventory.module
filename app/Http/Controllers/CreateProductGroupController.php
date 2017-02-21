<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductGroup;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateProductGroupController extends Controller
{
	function __construct()
	{
        $this->middleware('auth');
	}

	public function create()
	{
		return view('product_groups.create');
	}

	public function store(Request $request)
	{

		$this->validate($request, ['name' => 'required']);
	 	$new = ProductGroup::create($request->all());
	 	Alert::success('Grupo agregado correctamente');
	 	return redirect('/home');
	}
}
