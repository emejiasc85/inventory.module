<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Make;
use Illuminate\Http\Request;

class MakesController extends Controller
{
    public function index(Request $request)
    {

    	$makes = Make::name($request->get('name'))->orderBy('id', 'DESC')->paginate();
    	return view('makes.index', compact('makes'));
    }
}
