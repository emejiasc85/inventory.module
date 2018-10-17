<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Http\Resources\ProductResource;
use EmejiasInventory\Http\Requests\ProductQuickOrderStore;

class ProductQuickOrderController extends Controller
{
    public function store(ProductQuickOrderStore $request, Product $product)
    {
        $product->update(request()->only('price', 'offer_price'));
        $product->addToStock();

        return new ProductResource($product);
    }
}
