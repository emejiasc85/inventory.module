<?php
namespace EmejiasInventory\Traits;

use Illuminate\Support\Facades\DB;

/**
 * 
 */
trait OrderTrait
{
    
    public function scopeTopCustomers($query, $request)
    {
        $query->select(
            'people.id', 
            'people.nit', 
            'people.name', 
            'people.type', 
            'people.partner',
            DB::raw('SUM(orders.total) as total'),
            DB::raw("(SELECT SUM(payments.amount) FROM payments
            WHERE payments.order_id = orders.id
            GROUP ) as credit")
            //DB::raw('SUM(payments.amount) as credit')
        )
        ->leftJoin('people', 'people.id', '=', 'orders.people_id')
        ->leftJoin('payments', 'payments.order_id', '=', 'orders.id')
        ->where('orders.order_type_id', 2)
        ->where('orders.status', 'Ingresado')
        ->date($request->from, $request->to)
        ->groupBy('people.id', 'people.name', 'people.type', 'people.partner', 'people.nit')
        ->orderBy('total', 'DESC');
        return $query;
    }

    /*
    $data = DB::table("products")
    ->select("products.*",
    DB::raw("(SELECT SUM(products_stock.stock) FROM products_stock
    WHERE products_stock.product_id = products.id
    GROUP BY products_stock.product_id) as product_stock"),
    
    DB::raw("(SELECT SUM(products_sell.sell) FROM products_sell
    WHERE products_sell.product_id = products.id
    GROUP BY products_sell.product_id) as product_sell"))
    ->get();
    */
}
