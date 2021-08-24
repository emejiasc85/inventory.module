<?php

namespace tests\Feature;


use EmejiasInventory\Entities\OrderType;
use Tests\FeatureTestCase;

class ListOrderTypeTest extends FeatureTestCase
{
   function test_a_user_can_see_order_types_list()
    {
        //having
        $type = factory(OrderType::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('orders.type.index'))
        ->see('Tipos de ordenes')
        ->seeInElement('td', $type->name);
    }

    function test_a_user_can_paginate_order_types()
    {
    	//having
        $first_type = factory(OrderType::class)->create(['name' => 'Pedidos']);
        $types = factory(OrderType::class)->times(15)->create();
        $last_type = factory(OrderType::class)->create(['name' => 'Facturas']);

        $this->actingAs($this->defaultUser())
        ->visit(route('orders.type.index'))
        ->see('Tipos de ordenes')
        ->seeInElement('td', $last_type->name)
        ->dontSeeInElement('td', $first_type->name)
        ->click('2')
        ->seeInElement('td', $first_type->name)
        ->dontSeeInElement('td', $last_type->name);
    }

    function test_a_user_can_search_a_make()
    {
    	//having
        $first_type = factory(OrderType::class)->create(['name' => 'Pedidos']);
        $types = factory(OrderType::class)->times(15)->create();
        $last_type = factory(OrderType::class)->create(['name' => 'Facturas']);

        $this->actingAs($this->defaultUser())
        ->visit(route('orders.type.index'))
        ->see('Tipos de ordenes')
        ->type('Ped', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_type->name);

    }
}
