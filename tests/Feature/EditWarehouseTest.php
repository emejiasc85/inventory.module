<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Warehouse;
use Tests\FeatureTestCase;


class EditWarehouseTest extends FeatureTestCase
{

    function test_a_user_can_edit_a_unit_warehouses()
    {
        //having
       	$user = $this->defaultUser();
       	$warehouse = factory(Warehouse::class)->create();
       	//when
       	$this->actingAs($user)
       		->visit($warehouse->editUrl)
       		->see($warehouse->name)
       		->type('bodega 2', 'name')
       		->press('Editar');

       	//then
      	$this->seeInDatabase('warehouses', [
      		'name' => 'bodega 2'
      	]);

      	$this->see('Bodega editada correctamente');
    }
}
