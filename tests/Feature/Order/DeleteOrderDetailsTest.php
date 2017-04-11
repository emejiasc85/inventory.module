<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderDetail;
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class DeleteOrderDetailsTest extends FeatureTestCase
{
    function test_user_can_delete_order_details()
    {
        //having
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        $this->actingAs($this->defaultUser());
        $order = factory(Order::class)->create(['order_type_id' => 1]);
        $detail = factory(OrderDetail::class)->create(['order_id' => $order->id]);

        //when
        $this->visit($order->url)
        	->seeInElement('td', $detail->product->name)
        	->click('', 'a.OrderDetailDelete')
        	->see('¿Esta seguro de eliminarlo de esta orden?')
        	->type($detail->id, 'id')
        	->press('Eliminar');
        //then
        $this->seePageIs($order->url);
        $this->see('Se ha eliminado el detalle');
        $this->dontSeeInDatabase('order_details', ['order_id' =>  $detail->id]);
    }
}
