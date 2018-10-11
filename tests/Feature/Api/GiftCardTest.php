<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EmejiasInventory\Entities\GiftCard;

class GiftCardTest extends TestCase
{
    use RefreshDatabase;

    function test_gift_cards_list()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $card = factory(GiftCard::class)->create();

        $this->get('/api/gift-cards')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $card->id,
                    ]
                ]
            ]);
    }

    function test_search_gift_cards()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $card = factory(GiftCard::class)->create();
        $car2 = factory(GiftCard::class)->create();

        $this->call('GET', '/api/gift-cards', ['id' => $card->id])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $card->id,
                    ]
                ]
            ]);
    }

    public function test_store_range_of_gift_cards()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->defaultUser(), 'api');
        $params = [
            'number' => 30,
            'value' => 250,
        ];

        $this->postJson('/api/gift-cards', $params)
            ->assertStatus(201);

        $this->assertEquals(30, GiftCard::count());
        $this->assertDatabaseHas('gift_cards', [
            'value' => 250,
            'current_value' => 250,
            'status' => 0,
        ]);
    }
}
