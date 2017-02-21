<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\UnitMeasure;
use Tests\FeatureTestCase;


class EditUnitMeasuresTest extends FeatureTestCase
{
    function test_a_user_can_edit_a_unit_measures()
    {
        //having
       	$user = $this->defaultUser();
       	$unit = factory(UnitMeasure::class)->create();
       	//when
       	$this->actingAs($user)
       		->visit($unit->editUrl)
       		->see($unit->name)
       		->type('Kilo', 'name')
       		->press('Editar');

       	//then
      	$this->seeInDatabase('unit_measures', [
      		'name' => 'kilo'
      	]);

      	$this->see('Unidad editada correctamente');


    }
}
