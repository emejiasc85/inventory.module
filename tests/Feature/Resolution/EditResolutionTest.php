<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Resolution;
use Tests\FeatureTestCase;

class EditResolutionTest extends FeatureTestCase
{
    function test_user_can_edit_resolutions()
    {
        //having
        $resolution = factory(Resolution::class)->create();
        $this->actingAs($this->defaultUser());
        $fields = [
            'serie' => 'A',
            'from' => 1,
            'to' => 1000,
            'resolution' => '2015-5-247540' ,
            'date' => '2017-01-01',
        ];
        //when
        $this->visit($resolution->editUrl)
        ->form($fields);
        $this->press('Editar');
        //then
        $this->seeInDatabase('resolutions', $fields);


    }
}
