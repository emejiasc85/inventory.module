<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\{Order,Product};
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        $order = factory(Order::class)->create(['order_type_id' => 1]);
        $product = factory(Product::class)->create();
        $this->actingAs($this->defaultUser());
        $fields = [
        	'product_id' => $product->id,
        	'lot' => 10,
            'purchase_price' => 10
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
        $this->seeInDatabase('order_details', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'lot' => 10,
            'purchase_price' => 10,
            'total_purchase' => 100
        ]);
        $this->seeInDatabase('orders', [
            'id' => $order->id,
            'total' => 100
        ]);
        $this->see('Producto Agregado correctamente');
        $this->seePageIs($order->url);

    }
}
