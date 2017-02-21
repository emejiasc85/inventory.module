<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupsController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$groups = ProductGroup::name($request->get('name'))->orderBy('id', 'DESC')->paginate();

    	return view('product_groups.index', compact('groups'));
    }
}
