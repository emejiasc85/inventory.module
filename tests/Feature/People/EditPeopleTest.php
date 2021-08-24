<?php

namespace tests\Feature\People;

use EmejiasInventory\Entities\People;
use Tests\FeatureTestCase;


class EditPeopleTest extends FeatureTestCase
{
    function test_user_can_edit_people()
    {
        //having
        $this->actingAs($this->defaultUser());
        $people = factory(People::class)->create();

        $fields = [
            'nit'        => '6158063-5',
            'name'       => 'Enrique Mejias',
            'address'    => 'San benito',
            'phone'      => '54606633',
            'email'      => 'emejiasc85@gmail.com',
            'type'       => 'provider',
            'partner'    => true,
            'max_credit' => 5000
        ];
        //when
        $this->visit($people->editUrl)
        ->form($fields);
        $this->press('Editar');
        //then
        $this->seeInDatabase('people', $fields);
    }
}
