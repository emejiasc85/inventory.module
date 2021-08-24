<?php

namespace tests\Feature;

use Tests\FeatureTestCase;

class CreateProductPresentationsTest extends FeatureTestCase
{
    function test_a_user_can_create_a_product_presentation()
    {
       //when
        $this->actingAs($this->defaultUser())
        	->visit(route('product.presentations.create'))
        	->see('Presentaciones de Productos')
        	->type('Crema', 'name')
        	->type('unguento', 'description')
        	->press('Guardar');
         //then
        $this->seeInDatabase('product_presentations', [
        	'name' => 'Crema',
        	'description' => 'unguento',
        	'slug' => 'crema'
        ]);

        $this->see('Presentación agregada correctamente');
    }

    public function test_validate_form()
    {

    	//when
        $this->actingAs($this->defaultUser())
        	->visit(route('product.presentations.create'))
        	->see('Presentaciones de Productos')
        	->press('Guardar');

         //then
        $this->seeErrors([
        	'name' => 'El campo nombre es obligatorio'
        ]);
    }
}
