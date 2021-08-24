<?php

namespace tests\Feature;

use EmejiasInventory\Entities\Warehouse;
use Tests\FeatureTestCase;


class ListWarehousesTest extends FeatureTestCase
{
    function test_user_can_list_warehouses()
    {
         //having
        $warehouse = factory(Warehouse::class)->create();
        $this->actingAs($this->defaultUser())
        ->visit(route('warehouses.index'))
        ->see('Bodegas')
        ->seeInElement('td', $warehouse->name)
        ->seeInElement('td', $warehouse->description);
    }

    function test_a_user_can_paginate_warehouses()
    {
    	//having
        $first_warehouse = factory(Warehouse::class)->create(['name' => 'Bodega Farmacia']);
        $warehouses = factory(Warehouse::class)->times(15)->create();
        $last_warehouse = factory(Warehouse::class)->create(['name' => 'Bodega Vencidos']);

        $this->actingAs($this->defaultUser())
        ->visit(route('warehouses.index'))
        ->see('Bodegas')
        ->seeInElement('td', $last_warehouse->name)
        ->dontSeeInElement('td', $first_warehouse->name)
        ->click('2')
        ->seeInElement('td', $first_warehouse->name)
        ->dontSeeInElement('td', $last_warehouse->name);
    }

    function test_a_user_can_search_a_warehouses()
    {
    	//having
       	$first_warehouse = factory(Warehouse::class)->create(['name' => 'Bodega Farmacia']);
        $warehouses = factory(Warehouse::class)->times(15)->create();
        $last_warehouse = factory(Warehouse::class)->create(['name' => 'Bodega Vencidos']);

        $this->actingAs($this->defaultUser())
        ->visit(route('warehouses.index'))
        ->see('Bodegas')
        ->type('Farmacia', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_warehouse->name);

    }
}
