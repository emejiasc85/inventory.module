<?php

namespace EmejiasInventory\Http\Controllers\Api\Admin\Reports;

use Illuminate\Http\Request;
use EmejiasInventory\Http\Controllers\Controller;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Http\Resources\OrderDetailResource;

class ProductOrderReportController extends Controller
{
    public function index(Request $request)
    {
        $details = OrderDetail::query()
            ->isOrder()
            ->productId()
            ->dates()
            ->with(['product'])
            ->orderBy('id')
            ->paginateIf();
        return OrderDetailResource::collection($details);
    }
}
