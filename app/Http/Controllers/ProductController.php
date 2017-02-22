<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    	$products = Product::name($request->get('name'))->orderBy('id', 'DESC')->paginate();
    	return view('products.index', compact('products'));
    }
}
