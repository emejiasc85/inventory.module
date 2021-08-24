<?php

namespace tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\CashRegister;
use EmejiasInventory\Entities\CashRegisterDeposit;

class CashRegisterDepositTest extends TestCase
{
    use RefreshDatabase;
    function test_cash_register_deposits_list()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $cash_register = factory(CashRegister::class)->create();
        $deposit = factory(CashRegisterDeposit::class)->create(['cash_register_id' => $cash_register->id]);
        $params = ['cash_register_id' => $cash_register->id];
        $this->getJson('/api/cash-register-deposits', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $deposit->id
                    ]
                ]
            ]);
    }


    function test_store_cash_register_deposist()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $cash_register = factory(CashRegister::class)->create();
        $deposit = factory(CashRegisterDeposit::class)->make();
        $params = [
            'cash_register_id' => $cash_register->id,
            'baucher' => $deposit->baucher,
            'amount' => $deposit->amount,
            'bank' => $deposit->bank,
            'account' => $deposit->account,
            'date' => $deposit->date
        ];
        $this->postJson('/api/cash-register-deposits', $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'cash_register_id' => $cash_register->id
                ]
            ]);

        $this->assertDatabaseHas('cash_register_deposits', [
            'cash_register_id' => $cash_register->id,
            'baucher' => $deposit->baucher,
            'amount' => $deposit->amount,
            'bank' => $deposit->bank,
            'account' => $deposit->account,
            'date' => $deposit->date
        ]);
    }
    function test_validate_cash_register_deposist()
    {
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $cash_register = factory(CashRegister::class)->create();
        $deposit = factory(CashRegisterDeposit::class)->make();
        $params = [
            'cash_register_id' => $cash_register->id,
        ];
        $this->postJson('/api/cash-register-deposits', $params)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'baucher' => ['El campo No. Documento es obligatorio.'],
                    'amount' => ['El campo monto es obligatorio.'],
                    'bank' => ['El campo banco es obligatorio.'],
                    'account' => ['El campo cuenta es obligatorio.'],
                    'date' => ['El campo fecha es obligatorio.']
                ]
            ]);
    }

    function test_destroy_cash_register_deposit()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $deposit = factory(CashRegisterDeposit::class)->create();

        $this->deleteJson('/api/cash-register-deposits/'.$deposit->id)
            ->assertStatus(204);
        $this->assertSoftDeleted('cash_register_deposits', [
            'id' => $deposit->id
        ]);
    }
}
