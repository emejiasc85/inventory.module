<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\UnitMeasure;
use Illuminate\Http\Request;

class UnitMeasuresController extends Controller
{
    public function index(Request $request)
    {
    	$units = UnitMeasure::name($request->get('name'))->orderBy('id', 'DESC')->paginate();
    	return view('unit_measures.index', compact('units'));
    }
}
