<?php

namespace tests\Feature;

use EmejiasInventory\Entities\{Order, OrderDetail, Warehouse, Stock};
use Tests\FeatureTestCase;

class ReverseOrdersTest extends FeatureTestCase
{
    /*
    function test_user_can_reverse_orders()
    {
        //having
        $this->actingAs($this->defaultUser());
         $order = factory(Order::class)->create([
            'status' => 'Ingresado'
        ]);
        $detail = factory(OrderDetail::class)->create([
            'order_id'       => $order->id,
            'lot'            => 1,
            'purchase_price' => 10,
            'sale_price'     => 10,
            'total_purchase' =>10
        ]);
        $warehouse = factory(Warehouse::class)->create(['id' => 1]);
        $stock = Stock::create([
            'warehouse_id' => 1,
            'stock' => $detail->lot,
            'order_detail_id' => $detail->id
        ]);

        //when
        $this->visit($order->url)
        ->press('Revertir');

        //then
        $this->see('Pedido Revertido');
        $this->dontSeeInDatabase('stocks', [
            'id' => $stock->id
        ]);
        $this->dontSeeInDatabase('orders', [
            'id' => $order->id,
            'status' => 'Solicitado',
        ]);


    }
    */
}
