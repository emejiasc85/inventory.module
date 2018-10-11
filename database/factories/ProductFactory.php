<?php

use Faker\Generator as Faker;
use EmejiasInventory\Entities\ProductPresentation;
use EmejiasInventory\Entities\ProductGroup;
use EmejiasInventory\Entities\UnitMeasure;
use EmejiasInventory\Entities\Make;

$factory->define(EmejiasInventory\Entities\Product::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'full_name' => $name,
        'description' => $faker->paragraph,
        'barcode' => $faker->ean13,
        'product_presentation_id' => function () {
            return factory(ProductPresentation::class)->create()->id;
        },
        'product_group_id'  => function () {
            return factory(ProductGroup::class)->create()->id;
        },
        'unit_measure_id'   => function () {
            return factory(UnitMeasure::class)->create()->id;
        },
        'make_id'   => function () {
            return factory(Make::class)->create()->id;
        },
        'minimum_stock' => 5,
        'price' => $faker->randomDigitNotNull,
        'offer_price' => $faker->randomDigitNotNull,
    ];
});
