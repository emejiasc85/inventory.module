<?php

namespace Tests\Feature\api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\GiftCard;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\CashRegister;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\People;

class InvoiceGiftCardTest extends TestCase
{
    use RefreshDatabase;

    function test_store_invoice_gift_card()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $people = factory(People::class)->create();
        $gift_card = factory(GiftCard::class)->create([
            'value' => 350,
            'current_value' => 350,
        ]);

        $order_type = factory(OrderType::class)->create(['id' => 2]);
        $cash_register = factory(CashRegister::class)->create();
        $invoice = factory(Order::class)->create([
            'order_type_id'    => $order_type->id,
            'cash_register_id' => $cash_register->id,
            'status'           => 'Creado'
        ]);

        $params = [
            'gift_card_id'  => $gift_card->id,
        ];

        $this->postJson('/api/invoice/'.$invoice->id.'/gift-cards', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $invoice->id,
                    'gift_cards' => [
                        0 => [
                            'id' => $gift_card->id
                        ]
                    ]
                ]
            ]);
            $this->assertDatabaseHas('orders', [
                'id' => $invoice->id,
                'total' => 350,
             ]);

            $this->assertDatabaseHas('gift_card_order', [
                'order_id' => $invoice->id,
                'gift_card_id' => $gift_card->id
            ]);
    }

    function test_destroy_invoice_gift_card()
    {
        $this->withoutExceptionHandling();
        $user =  $this->defaultUser();
        $this->actingAs($user, 'api');
        $people = factory(People::class)->create();
        $gift_card = factory(GiftCard::class)->create([
            'value' => 350,
            'current_value' => 350,
        ]);

        $order_type = factory(OrderType::class)->create(['id' => 2]);
        $cash_register = factory(CashRegister::class)->create();
        $invoice = factory(Order::class)->create([
            'order_type_id'    => $order_type->id,
            'cash_register_id' => $cash_register->id,
            'status'           => 'Creado'
        ]);

        $invoice->gift_cards()->attach($gift_card->id);
        $invoice->sumTotals();
        $invoice->save();

        $this->deleteJson('/api/invoice/'.$invoice->id.'/gift-cards', ['gift_card_id' => $gift_card->id])
            ->assertStatus(204);

        $this->assertDatabaseHas('orders', [
            'id' => $invoice->id,
            'total' => 0,
        ]);

       /*  $this->assertDatabaseMissing()('gift_card_order', [
            'order_id' => $invoice->id,
            'gift_card_id' => $gift_card->id
        ]); */
    }
}
