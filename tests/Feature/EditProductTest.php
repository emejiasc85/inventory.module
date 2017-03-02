<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\{Product, Make, ProductGroup, ProductPresentation, UnitMeasure };
use Tests\FeatureTestCase;

class EditProductTest extends FeatureTestCase
{
    function test_a_user_can_edit_a_product()
    {
    	//having
    	$make = factory(Make::class)->create(['name' => 'Bayer']);
    	$group = factory(ProductGroup::class)->create(['name' => 'Medicina']);
    	$presentation = factory(ProductPresentation::class)->create(['name' => 'Pastilla']);
    	$unit = factory(UnitMeasure::class)->create(['name' => 'Unidad']);
    	$product = factory(Product::class)->create();

    	$fields = [
    		'name' 			=> 'alka seltzer',
    		'description' 	=> 'Pastilla esfervecente',
    		'barcode' 		=> '1234567',
    		'product_presentation_id' => $presentation->id,
    		'product_group_id' 	=> $group->id,
    		'unit_measure_id' 	=> $unit->id,
    		'minimum_stock' 	=> 5,
            'make_id'           => $make->id
    	];
    	//when
    	$this->actingAs($this->defaultUser())
    		->visit($product->editUrl)
    		->see($product->name);
    	$this->form($fields);
    	$this->press('Editar');

    	//then
    	$this->seeInDatabase('products', $fields);
    	$this->see('Producto editado correctamente');
    }
}
