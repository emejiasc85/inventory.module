<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use EmejiasInventory\Entities\Product;
use Tests\FeatureTestCase;

class EditOrderDetailsTest extends FeatureTestCase
{
        /*
    function test_user_can_edit_order_details()
    {

        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create(['name' => 'acetaminofen']);
        $this->actingAs($this->defaultUser());
        $detail = factory(OrderDetail::class)->create([
            'product_id'     => $product->id,
            'order_id'       => $order->id,
            'lot'            => 10,
            'purchase_price' => 80
        ]);
        //having
        $this->visit($order->url)
            ->seeInElement('td', $detail->product->name)
            ->type(6, 'lot[]')
            ->type(10, 'purchase_price[]')
            ->type('2017-03-04', 'due_date[]')
            ->press('Guardar');

        //then
        $this->seeInDatabase('order_details', [
            'id'             => $detail->id,
            'order_id'       => $order->id,
            'lot'            => 6,
            'purchase_price' => 10,
            'total_purchase' => 60,
        ]);
        $this->seeInDatabase('orders', [
            'id'    => $order->id,
            'total' => 60
        ]);
        $this->see('Detalle Editado correctamente');
        $this->seePageIs($order->url);
    }
         */
}
