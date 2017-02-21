<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\ProductPresentation;
use Tests\FeatureTestCase;


class ListProductPresentationsTest extends FeatureTestCase
{
   function test_a_user_can_list_a_product_presentations()
    {
    	//having
        $presentation = factory(ProductPresentation::class)->create();
        //then
        $this->actingAs($this->defaultUser())
        	->visit(route('product.presentations.index'))
        	->see('Presentaciones de Productos')
        	->seeInElement('td', $presentation->name);
    }

     function test_a_user_can_paginate_product_presentations()
    {
        //having
        $first_presentation = factory(ProductPresentation::class)->create(['name' => 'Colonias']);
        $presentations = factory(ProductPresentation::class)->times(15)->create();
        $last_presentation = factory(ProductPresentation::class)->create(['name' => 'Medicina']);

        $this->actingAs($this->defaultUser())
        ->visit(route('product.presentations.index'))
        ->see('Presentaciones de Productos')
        ->seeInElement('td', $last_presentation->name)
        ->dontSeeInElement('td', $first_presentation->name)
        ->click('2')
        ->seeInElement('td', $first_presentation->name)
        ->dontSeeInElement('td', $last_presentation->name);
    }

    function test_a_user_can_search_a_product_presentation()
    {
        //having
        $first_presentation = factory(ProductPresentation::class)->create(['name' => 'Colonias']);
        $presentations = factory(ProductPresentation::class)->times(15)->create();
        $last_presentation = factory(ProductPresentation::class)->create(['name' => 'Medicina']);
        //when
        $this->actingAs($this->defaultUser())
        ->visit(route('product.presentations.index'))
        ->see('Presentaciones de Productos')
        ->type('Colonias', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_presentation->name);

    }
}
