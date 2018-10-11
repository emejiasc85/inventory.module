<?php

use Illuminate\Database\Seeder;
use EmejiasInventory\Entities\GiftCard;
use Illuminate\Support\Collection;

class GiftCardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = Collection::times(30, function ($number) {
            return factory(GiftCard::class)->create([
                'value' => 250,
                'current_value' => 250,
                'status' => false
            ]);
        });
    }
}
