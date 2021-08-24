<?php

namespace tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CashRegisterTest extends TestCase
{
    use RefreshDatabase;

    function test_store_cash_register()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $params = [
            'initial_cash' => 100 ,
        ];

        $this->postJson('/api/cash-register', $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'initial_cash' => 100
                ]
            ]);


        $this->assertDatabaseHas('cash_registers', [
            'initial_cash' => 100 ,
            'user_id' => $user->id,
            'status' => 0
        ]);
    }
}
