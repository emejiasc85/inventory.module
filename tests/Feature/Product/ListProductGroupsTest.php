<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\ProductGroup;
use Tests\FeatureTestCase;


class ListProductGroupsTest extends FeatureTestCase
{
    function test_a_user_can_list_a_product_groups()
    {
    	//having
        $group = factory(ProductGroup::class)->create();
        //then
        $this->actingAs($this->defaultUser())
        	->visit(route('product.groups.index'))
        	->see('Grupos de Productos')
        	->seeInElement('td', $group->name);
    }

     function test_a_user_can_paginate_product_groups()
    {
        //having
        $first_group = factory(ProductGroup::class)->create(['name' => 'Colonias']);
        $groups = factory(ProductGroup::class)->times(15)->create();
        $last_group = factory(ProductGroup::class)->create(['name' => 'Medicina']);

        $this->actingAs($this->defaultUser())
        ->visit(route('product.groups.index'))
        ->see('Grupos de Productos')
        ->seeInElement('td', $last_group->name)
        ->dontSeeInElement('td', $first_group->name)
        ->click('2')
        ->seeInElement('td', $first_group->name)
        ->dontSeeInElement('td', $last_group->name);
    }

    function test_a_user_can_search_a_product_group()
    {
        //having
        $first_group = factory(ProductGroup::class)->create(['name' => 'Colonias']);
        $groups = factory(ProductGroup::class)->times(15)->create();
        $last_group = factory(ProductGroup::class)->create(['name' => 'Medicina']);
        //when
        $this->actingAs($this->defaultUser())
        ->visit(route('product.groups.index'))
        ->see('Grupos de Productos')
        ->type('Colonias', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_group->name);

    }


}
