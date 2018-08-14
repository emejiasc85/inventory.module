<?php

namespace EmejiasInventory\Http\Controllers;

use EmejiasInventory\Entities\{
	ProductPresentation,
	ProductGroup,
	UnitMeasure,
	Product
};
use EmejiasInventory\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class CreateProductsController extends Controller
{

    public function create()
    {
    	return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $name=$request->input('name');
        $val1=substr($name, 0, 1);
        $val2=substr($name,1, 1);
        $val3=substr($name, 2, 2);
        $salida=ord($val1).ord($val2).ord($val3);
        $new = Product::create($request->all());
        if ($request->barcode == '') {
            $new->barcode=$salida.$new->id;
            $new->save();
        }
    	Alert::success('Producto creado correctamente');
    	return redirect()->route('products.index');
    }
}
