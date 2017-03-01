<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Product, ProductImage};
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class ProductImagesController extends Controller
{
    public function create(Product $product, $slug)
    {
    	return view('product_images.create',compact('product'));
    }

    public function store(Request $request, Product $product)
    {
    	$this->validate($request, ['description' => 'required', 'img' => '']);
    	$image = new ProductImage();
    	if ($request->hasFile('img'))
        {
            $image->img_path = $request->file('img')->store('product_images');
        }
		$image->description = $request->get('description');
        $image->product_id = $product->id;
		$image->save();
    	Alert::success('Imagen agregada correctamente');
    	return redirect()->back();
    }
}
