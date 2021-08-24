<?php

namespace tests\Feature;

use EmejiasInventory\Entities\OrderType;
use Tests\FeatureTestCase;


class EditOrderTypeTest extends FeatureTestCase
{
   	function test_a_user_can_edit_a_order_type()
    {
        //having
       	$user = $this->defaultUser();
       	$type = factory(OrderType::class)->create();
       	//when
       	$this->actingAs($user)
       		->visit($type->editUrl)
       		->see($type->name)
       		->type('Vencidos', 'name')
       		->press('Editar');

       	//then
      	$this->seeInDatabase('order_types', [
      		'name' => 'Vencidos'
      	]);

      	$this->see('Tipo de orden editado correctamente');

    }
}
