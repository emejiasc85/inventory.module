<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Http\Resources\ProductResource;
use EmejiasInventory\Http\Requests\ProductStore;
use EmejiasInventory\Http\Requests\ProductUpdate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::id()
            ->barcode()
            ->name()
            ->makeId()
            ->unitId()
            ->serieId()
            ->presentationId()
            ->groupId()
            ->orderByDesc('id')
            ->paginateIf();
        return ProductResource::collection($products);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        $product = Product::create(request()->all());
        $product->addBarcode();
        $product->colors()->sync(request()->colors);
        $product->addToStock();

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request, Product $product)
    {
        $product->update(request()->all());
        $product->addBarcode();
        $product->colors()->sync(request()->colors);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
