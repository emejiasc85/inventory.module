<?php

namespace tests\Feature;

use Tests\FeatureTestCase;

class CreateUnitMeasuresTest extends FeatureTestCase
{
    function test_a_user_can_create_a_unit_measures()
    {
        //having
        $user = $this->defaultUser();

        //when
        $this->actingAs($user)
      		->visit(route('unit.measures.create'))
      		->see('Unidades de Medida')
      		->type('Litro', 'name')
      		->press('Guardar');

      	//then
      	$this->seeInDatabase('unit_measures', [
      		'name' => 'Litro'
      	]);

      	$this->see('Unidad agregada correctamente');
    }


    function test_validate_form_on_create_a_unit_measures()
    {
    	 //having
        $user = $this->defaultUser();

        //when
        $this->actingAs($user)
      		->visit(route('unit.measures.create'))
      		->see('Unidades de Medida')
      		->press('Guardar');

      	//then
      	$this->seeErrors([
      		'name' => 'El campo nombre es obligatorio'
      	]);

    }
}
