<?php
namespace EmejiasInventory\Traits;

use Illuminate\Support\Facades\DB;

/**
 * 
 */
trait OrderDetailTrait
{
    
    public function scopeTopProducts($query, $request)
    {
        $query->selectRaw('products.id, products.name, sum(order_details.lot) as cant')
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
        ->whereRaw('orders.order_type_id =2')
        ->productName($request->name)
        ->date($request->from, $request->to)
        ->groupBy('products.id', 'products.name')
        ->orderBy('cant', ($request->order == null ? 'DESC': $request->order));
        return $query;
    }

    public function scopeTopProductsByDate($query, $request)
    {
        $query->selectRaw('DATE(orders.created_at) as date, products.id, products.name, sum(order_details.lot) as cant')
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
        ->whereRaw('orders.order_type_id = 2')
        ->productName($request->name)
        ->date($request->from, $request->to)
        ->groupBy('products.id', 'products.name', DB::raw('Date(orders.created_at)'))
        ->orderBy('date', ($request->order == null ? 'DESC': $request->order));
        return $query;
    }
}
