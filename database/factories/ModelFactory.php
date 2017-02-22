<?php

use EmejiasInventory\Entities\{User, Commerce, Make, ProductGroup, ProductPresentation, UnitMeasure, Product};
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
        'slug' => Str::slug($name)
    ];
});


$factory->define(Make::class, function (Faker\Generator $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});
$factory->define(UnitMeasure::class, function (Faker\Generator $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});

$factory->define(ProductGroup::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});
$factory->define(ProductPresentation::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});
$factory->define(Product::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name'          => $name,
        'full_name'     => $name,
        'description'   => $faker->paragraph,
        'barcode'       => $faker->ean13,
        'product_presentation_id' => function () {
            return factory(ProductPresentation::class)->create()->id;
        },
        'product_group_id'  => function () {
            return factory(ProductGroup::class)->create()->id;
        },
        'unit_measure_id'   => function () {
            return factory(UnitMeasure::class)->create()->id;
        },
        'minimum_stock'     => 5,
    ];
});