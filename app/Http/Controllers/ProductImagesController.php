<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{Product, ProductImage};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProductImagesController extends Controller
{
    public function create(Product $product, $slug)
    {
    	return view('product_images.create',compact('product'));
    }

    public function store(Request $request, Product $product)
    {
    	$this->validate($request, ['description' => 'max:255', 'img' => '']);
    	$image = new ProductImage();
    	if ($request->hasFile('img'))
        {
            $image->img_path = $request->file('img')->store('product_images');
        }
		$image->description = $request->get('description');
        $image->product_id = $product->id;
		$image->save();
    	Alert::success('Imagen agregada correctamente');
    	return redirect($product->url);
    }

    function img(ProductImage $image)
    {

      $header = [
        'Content-lenght'  => File::size($image->imgFile),
        'Content-type'    => File::mimeType($image->imgFile)
      ];

      return response()->download(
        $image->imgFile,
        null, $header, ResponseHeaderBag::DISPOSITION_INLINE
      );
    }

    public function delete(Request $request)
    {

        if (trim($request->get('id')))
        {
            $image = ProductImage::findOrFail($request->get('id'));
            $image->delete();
            Storage::delete($image->img_path);
            alert::success('Imagen Borrada exitosamente');

            return redirect()->back();

        }

        alert::warning('Debe Seleccionar una imagen');

        return redirect()->back();
    }
}
