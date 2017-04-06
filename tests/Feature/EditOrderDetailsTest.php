<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Product;
use Tests\FeatureTestCase;

class EditOrderDetailsTest extends FeatureTestCase
{
    function test_user_can_edit_order_details()
    {
        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create(['name' => 'acetaminofen']);
        $this->actingAs($this->defaultUser());
        $detail = factory(OrderDetail::class)->create([
            'product_id' => $product->id,
            'order_id'   => $order->id,
            'lot'        => 10,
            'cost'       => 80
        ]);
        //having
        $this->visit($order->url)
            ->seeInElement('td', $detail->product->name)
            ->type(6, 'lot')
            ->type(10, 'cost')
            ->type('2017-03-04', 'due_date')
            ->press('Editar');

        //then
        $this->seeInDatabase('order_details', [
            'id'       => $detail->id,
            'order_id' => $order->id,
            'lot'      => 6,
            'cost'     => 10,
            'total'    => 60,
        ]);
        $this->seeInDatabase('orders', [
            'id'    => $order->id,
            'total' => 60
        ]);
        $this->see('Detalle Editado correctamente');
        $this->seePageIs($order->url);
    }
}
