<?php

use Faker\Generator as Faker;

$factory->define(EmejiasInventory\Entities\GiftCard::class, function (Faker $faker) {
    return [
        'value' => $faker->randomDigit,
        'current_value' => $faker->randomDigit,
        'status' => $faker->boolean
    ];
});
