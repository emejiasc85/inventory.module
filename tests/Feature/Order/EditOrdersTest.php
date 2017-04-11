<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\People;
use Tests\FeatureTestCase;

class EditOrdersTest extends FeatureTestCase
{
    function test_user_can_edit_orders()
    {
        //having
        $this->actingAs($this->defaultUser());
        $order    = factory(Order::class)->create();
        $provider = factory(People::class)->create(['name' => 'Lab. Prominente']);
        $comerce  = factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);

        //when
        $this->visit($order->editUrl)
        	->select($provider->id, 'provider_id')
        	->select('Media', 'priority')
        	->press('Editar');

        //the
        $this->seeInDatabase('orders', [
        	'provider_id' => $provider->id,
        	'priority' => 'Media'
        ]);
        $this->see('Pedido editada correctamente');
    }
}
