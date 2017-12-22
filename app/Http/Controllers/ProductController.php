<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    public function index(Request $request)
    {

        $products = Product::name($request->get('name'))
            ->id($request->id)
            ->makes($request->get('make_id'))
    		->group($request->get('product_group_id'))
    		->presentation($request->get('product_presentation_id'))
    		->unit($request->get('unit_measure_id'))
    		->barcode($request->get('barcode'))
    		->orderBy('id', 'DESC')
    		->paginate();
    	return view('products.index', compact('products'));
    }

    public function barcode(Product $product)
    {
        return view('products.partials.printbc', compact('product'));
    }
}
