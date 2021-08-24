<?php

namespace tests\Feature;

use EmejiasInventory\Entities\Commerce;
use Tests\FeatureTestCase;

class ListCommercesTest extends FeatureTestCase
{
    function test_user_can_list_commerces()
    {
        //having
        $name    = 'Farmacia Maya';
        $address = 'Santa Elena';
        $phone  = '79261212';
        $nit     = '61580635';
        $this->actingAs($this->defaultUser());
        $commerce = factory(Commerce::class)->create([
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'nit' => $nit,
        ]);
        //when
        $this->visit(route('commerces.index'))
            ->seePageIs(route('commerces.index'))
            ->seeInElement('td', $name)
            ->seeInElement('td', $address)
            ->seeInElement('td', $phone)
            ->seeInElement('td', $nit);
    }
}
