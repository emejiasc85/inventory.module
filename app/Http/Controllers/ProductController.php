<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;
use EmejiasInventory\Entities\Commerce;

class ProductController extends Controller
{

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    public function index(Request $request)
    {
        $products = Product::name($request->name)
            ->id($request->id)
            //->makes($request->make_id)
    		//->group($request->product_group_id)
    		//->presentation($request->product_presentation_id)
    		//->unit($request->unit_measure_id)
    		->barcode($request->barcode)
    		->orderBy('id', 'DESC')
    		->paginate();
    	return view('products.index', compact('products'));
    }

    public function barcode(Product $product)
    {
        $commerce = Commerce::first();
        return view('products.partials.printbc', compact('product', 'commerce'));
    }
}
