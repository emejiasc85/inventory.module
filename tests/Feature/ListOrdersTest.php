<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Order;
use Tests\FeatureTestCase;


class ListOrdersTest extends FeatureTestCase
{
    function test_a_user_can_see_order_list()
    {
        //having
        $order = factory(Order::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('orders.index'))
        ->see('Ordenes')
        ->seeInElement('td', $order->id)
        ->seeInElement('td', $order->type->name)
        ->seeInElement('td', $order->provider->name)
        ->seeInElement('td', $order->priority);
    }

    function test_a_user_can_paginate_orders()
    {
    	//having
        $first_order = factory(Order::class)->create();
        $orders = factory(Order::class)->times(15)->create();
        $last_order = factory(Order::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('orders.index'))
        ->see('Ordenes')
        ->seeInElement('td', $last_order->id)
        ->dontSeeInElement('td', $first_order->id)
        ->click('2')
        ->seeInElement('td', $first_order->id)
        ->dontSeeInElement('td', $last_order->id);
    }

    function test_a_user_can_search_a_order()
    {
    	//having
       	$first_order = factory(Order::class)->create();
        $orders = factory(Order::class)->times(15)->create();
        $last_order = factory(Order::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('orders.index'))
        ->see('Ordenes')
        ->type($first_order->id, 'id')
        ->press('Buscar')
        ->seeInElement('td', $first_order->id);

    }
}
