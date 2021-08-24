<?php

namespace tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;


class CreateQuotesTest extends FeatureTestCase
{
    function test_user_can_create_quotes()
    {
        //having
        $this->actingAs($this->defaultUser());
        Artisan::call('db:seed', ['--class' => 'CommerceTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'PeopleTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        //when
        $this->visit(route('quotes.create'))
            ->type('61580635', 'nit')
            ->type('Enrique Mejias', 'name')
            ->type('san benito', 'address')
            ->press('Siguiente');

        $this->seeInDatabase('orders', [
            'order_type_id' => 4,
            'people_id' => 2
        ]);
    }
}
