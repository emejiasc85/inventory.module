<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductPresentation;
use Illuminate\Http\Request;

class ProductPresentationsController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$presentations = ProductPresentation::name($request->get('name'))->orderBy('id', 'DESC')->paginate();

    	return view('product_presentations.index', compact('presentations'));
    }
}
