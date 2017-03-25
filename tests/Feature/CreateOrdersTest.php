<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\{Commerce,OrderType,User};
use Tests\FeatureTestCase;

class CreateOrdersTest extends FeatureTestCase
{
    function test_a_user_can_create_a_order()
    {
        //having
        $user 		= $this->defaultUser(['name' => 'Sonia Baldizon']);
        $provider	= factory(User::class)->create(['name' => 'Lab. Prominente']);
        $comerce 	= factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);
        $orderType 	= factory(OrderType::class)->create(['name' => 'Pedido']);
        $this->actingAs($user);

        $fields = [
        	'provider_id'	=> $provider->id,
        	'order_type_id' =>  $orderType->id,
        	'priority'		=> 'Alta'
       	];
        //having
        $this->visit(route('orders.create'))
        	->see('Orden')
        	->form($fields);
        $this->press('Siguiente');

        //then
        $this->seeInDatabase('orders', $fields);
    }
}
