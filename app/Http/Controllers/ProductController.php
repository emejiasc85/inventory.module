<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
	}
    public function index(Request $request)
    {
    	$products = Product::name($request->get('name'))
    		->group($request->get('product_group_id'))
    		->presentation($request->get('product_presentation_id'))
    		->unit($request->get('unit_measure_id'))
    		->orderBy('id', 'DESC')
    		->paginate();
    	return view('products.index', compact('products'));
    }
}
