<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\{Order,Product};
use Tests\FeatureTestCase;

class CreateOrderDetailsTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_create_orders_details()
    {
    	//having
        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create();
        $this->actingAs($this->defaultUser());
        $fields = [
        	'product_id' => $product->id,
        	'lot' => 10,
       	];
        //when
        $this->visit(route('orders.details.create', $order))
        ->type($product->name, 'name')
        ->press('Buscar')
        ->seeInElement('td', $product->name)
        ->click('', 'add-product')
        ->form($fields);
        $this->press('Agregar');

        //then
        $this->seeInDatabase('order_details', $fields);
        $this->see('Producto Agregado correctamente');
        $this->seePageIs($order->url);

    }
}
