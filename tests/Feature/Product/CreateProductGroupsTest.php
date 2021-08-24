<?php

namespace tests\Feature;

use Tests\FeatureTestCase;


class CreateProductGroupsTest extends FeatureTestCase
{
    function test_a_user_can_create_a_product_group()
    {
    	//when
        $this->actingAs($this->defaultUser())
        	->visit(route('product.groups.create'))
        	->see('Grupos de Productos')
        	->type('Medicina', 'name')
        	->type('drogas', 'description')
        	->press('Guardar');
         //then
        $this->seeInDatabase('product_groups', [
        	'name' => 'Medicina',
        	'description' => 'drogas',
        	'slug' => 'medicina'
        ]);

        $this->see('Grupo agregado correctamente');

    }

    public function test_validate_form()
    {

    	//when
        $this->actingAs($this->defaultUser())
        	->visit(route('product.groups.create'))
        	->see('Grupos de Productos')
        	->press('Guardar');

         //then
        $this->seeErrors([
        	'name' => 'El campo nombre es obligatorio'
        ]);
    }
}
