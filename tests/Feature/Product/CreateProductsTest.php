<?php

namespace tests\Feature;

use EmejiasInventory\Entities\{Make, ProductPresentation, ProductGroup, UnitMeasure};
use Tests\FeatureTestCase;

class CreateProductsTest extends FeatureTestCase
{
    function test_a_user_can_create_a_product()
    {
    	//having
    	$make = factory(Make::class)->create(['name' => 'Bayer']);
    	$group = factory(ProductGroup::class)->create(['name' => 'Medicina']);
    	$presentation = factory(ProductPresentation::class)->create(['name' => 'Pastilla']);
    	$unit = factory(UnitMeasure::class)->create(['name' => 'Unidad']);

    	$fields = [
    		'name' 			=> 'alka seltzer',
    		'description' 	=> 'Pastilla esfervecente',
    		'barcode' 		=> '1234567',
    		'product_presentation_id' => $presentation->id,
    		'product_group_id' 	=> $group->id,
    		'unit_measure_id' 	=> $unit->id,
            'make_id'           => $make->id,
    		'minimum_stock' 	=> 5,
    	];
    	//when
    	$this->actingAs($this->defaultUser())
    		->visit(route('products.create'))
    		->see('Productos');
    	$this->form($fields);
    	$this->press('Guardar');

    	//then
    	$this->seeInDatabase('products', $fields);
    	$this->see('Producto creado correctamente');
    }

    function test_validate_form()
    {
        //having
        $make = factory(Make::class)->create(['name' => 'Bayer']);
        $group = factory(ProductGroup::class)->create(['name' => 'Medicina']);
        $presentation = factory(ProductPresentation::class)->create(['name' => 'Pastilla']);
        $unit = factory(UnitMeasure::class)->create(['name' => 'Unidad']);

        //when
        $this->actingAs($this->defaultUser())
            ->visit(route('products.create'))
            ->see('Productos')
            ->press('Guardar');
        //then
        $this->seeErrors([
            'name' => 'El campo nombre es obligatorio',
            'description' => 'El campo descripción es obligatorio',
            'product_presentation_id' => 'El campo presentación es obligatorio',
            'product_group_id' => 'El campo grupo es obligatorio',
            'unit_measure_id' => 'El campo unidad de medida es obligatorio',
            'make_id' => 'El campo marca es obligatorio'
        ]);

    }
}
