<?php

use Faker\Generator as Faker;

$factory->define(EmejiasInventory\Entities\People::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'nit' => $faker->unique()->randomNumber(),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
    ];
});
