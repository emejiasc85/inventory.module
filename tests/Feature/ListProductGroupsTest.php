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
}
