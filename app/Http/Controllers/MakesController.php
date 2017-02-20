<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Make;
use Illuminate\Http\Request;

class MakesController extends Controller
{
    public function index()
    {
    	$makes = Make::orderBy('id', 'DESC')->paginate();
    	return view('makes.index', compact('makes'));
    }
}
