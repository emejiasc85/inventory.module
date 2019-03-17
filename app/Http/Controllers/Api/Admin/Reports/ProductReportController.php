<?php

namespace EmejiasInventory\Http\Controllers\Api\Admin\Reports;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Http\Resources\Admin\Report\ProductResource;

class ProductReportController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::id()
            ->barcode()
            ->name()
            ->makes()
            ->unit()
            ->serie()
            ->presentation()
            ->groups()
            ->with(['order_details', 'sale_details'])
            ->orderByDesc('id')
            ->paginateIf();
        return ProductResource::collection($products);
    }
}
