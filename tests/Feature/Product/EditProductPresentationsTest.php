<?php

namespace tests\Feature;

use EmejiasInventory\Entities\ProductPresentation;
use Tests\FeatureTestCase;


class EditProductPresentationsTest extends FeatureTestCase
{
    function test_a_user_can_edit_a_make()
    {
        //having
       	$user = $this->defaultUser();
       	$presentation = factory(ProductPresentation::class)->create();
       	//when
       	$this->actingAs($user)
       		->visit($presentation->editUrl)
       		->see($presentation->name)
       		->type('Gel', 'name')
       		->press('Editar');

       	//then
      	$this->seeInDatabase('product_presentations', [
      		'name' => 'Gel',
      		'slug' => 'gel'
      	]);

      	$this->see('Presentación editada correctamente');


    }
}
