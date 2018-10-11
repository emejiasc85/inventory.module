<?php

namespace EmejiasInventory\Http\Controllers\Api;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\Stock;
use EmejiasInventory\Http\Resources\StockResource;

class StockController extends Controller
{
    public function index()
    {
        $data = request()->all();
        $data = array_where($data, function ($value, $key) {
            return is_string($value);
        });

        if (empty($data)) {
            return response()->json(['data' => []]);
        }

        $products = Stock::stockFilter()->get();

        return StockResource::collection($products);
    }
}
