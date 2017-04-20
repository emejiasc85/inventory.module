<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class CreateBillsTest extends FeatureTestCase
{
    function test_user_can_create_bills()
    {
        //having
        $this->actingAs($this->defaultUser());
        Artisan::call('db:seed', ['--class' => 'CommerceTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'PeopleTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        //when
        $this->visit('/')
            ->seeLink('Facturar')
            ->click('Facturar')
            ->seePageIs(route('bills.create'))
            ->type('61580635', 'nit')
            ->type('Enrique Mejias', 'name')
            ->type('san benito', 'address')
            ->press('Siguiente');

        $this->seeInDatabase('orders', [
            'order_type_id' => 2,
            'people_id' => 2
        ]);
    }
}
