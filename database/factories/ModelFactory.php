<?php

use EmejiasInventory\Entities\{User, Commerce};
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Commerce::class, function (Faker\Generator $faker) {

    $name = $faker->company;
    return [
        'name' => $name,
    	'patent_name' => $name,
    	'patent' => $faker->randomNumber,
    	'address' => $faker->address,
    	'phone' =>  $faker->e164PhoneNumber,
    	'other_phone' => $faker->e164PhoneNumber,
    	'nit' => $faker->randomNumber,
    	'tax' => 3,
    	'profit' => 10,
    ];
});