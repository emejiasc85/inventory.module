<?php

namespace tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class CreateResolutionTest extends FeatureTestCase
{
    function test_user_can_create_resolutions()
    {
        Artisan::call('db:seed', ['--class' => 'CommerceTableSeeder']);
        $user = $this->defaultUser();
        $this->actingAs($user);
        $fields = [
            'serie' => 'A',
            'from' => 1,
            'to' => 1000,
            'resolution' => '2015-5-247540' ,
            'date' => '2017-01-01',
            'commerce_id' => 1
        ];

        //when
        $this->visit(route('resolutions.create'))
        ->form($fields);
        $this->press('Guardar');
        //then
        $this->seeInDatabase('resolutions', $fields);
    }
}
