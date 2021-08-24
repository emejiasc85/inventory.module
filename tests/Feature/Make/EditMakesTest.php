<?php

namespace tests\Feature;

use EmejiasInventory\Entities\Make;
use Tests\FeatureTestCase;


class EditMakesTest extends FeatureTestCase
{
    function test_a_user_can_edit_a_make()
    {
        //having
       	$user = $this->defaultUser();
       	$make = factory(Make::class)->create();
       	//when
       	$this->actingAs($user)
       		->visit($make->editUrl)
       		->see($make->name)
       		->type('Incaparina', 'name')
       		->press('Editar');

       	//then
      	$this->seeInDatabase('makes', [
      		'name' => 'Incaparina'
      	]);

      	$this->see('Marca editada correctamente');


    }
}
