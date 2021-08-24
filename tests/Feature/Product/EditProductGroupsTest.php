<?php

namespace tests\Feature;

use EmejiasInventory\Entities\ProductGroup;
use Tests\FeatureTestCase;

class EditProductGroupsTest extends FeatureTestCase
{
    function test_a_user_can_edit_a_product_group()
    {
    	//having
		$group = factory(ProductGroup::class)->create();
		//when
		$this->actingAs($this->defaultUser())
			->visit($group->editUrl)
			->see($group->name)
			->type('Colonias', 'name')
			->press('Editar');

		//then
		$this->seeInDatabase('product_groups', [
			'name' => 'Colonias',
			'slug' => 'colonias'
		]);

		$this->see('Grupo editado correctament');
    }
}
