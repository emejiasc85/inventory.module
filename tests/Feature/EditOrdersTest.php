<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\User;
use Tests\FeatureTestCase;

class EditOrdersTest extends FeatureTestCase
{
    function test_user_can_edit_orders()
    {
        //having
        $this->actingAs($this->defaultUser());
        $order = factory(Order::class)->create();
        $provider	= factory(User::class)->create(['name' => 'Lab. Prominente']);
        $comerce 	= factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);
        $orderType 	= factory(OrderType::class)->create(['name' => 'Pedido']);

        //when
        $this->visit($order->editUrl)
        	->select($provider->id, 'provider_id')
        	->select($orderType->id, 'order_type_id')
        	->select('Media', 'priority')
        	->press('Siguiente');

        //the
        $this->seeInDatabase('orders', [
        	'provider_id' => $provider->id,
        	'order_type_id' => $orderType->id,
        	'priority' => 'Media'
        ]);
        $this->see('Orden editada correctamente');
    }
}
