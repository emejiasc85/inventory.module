<?php

use Faker\Generator as Faker;

$factory->define(EmejiasInventory\Entities\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
