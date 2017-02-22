<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Product;
use Tests\FeatureTestCase;

class ListProductsTest extends FeatureTestCase
{
    function test_a_user_can_see_products_list()
    {
        //having
        $product = factory(Product::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('products.index'))
        ->see('Productos')
        ->seeInElement('td', $product->name);
    }

    function test_a_user_can_paginate_products()
    {
    	//having
        $first_product = factory(Product::class)->create(['name' => 'Alka']);
        $products = factory(Product::class)->times(15)->create();
        $last_product = factory(Product::class)->create(['name' => 'Acetaminofen']);

        $this->actingAs($this->defaultUser())
        ->visit(route('products.index'))
        ->see('Productos')
        ->seeInElement('td', $last_product->name)
        ->dontSeeInElement('td', $first_product->name)
        ->click('2')
        ->seeInElement('td', $first_product->name)
        ->dontSeeInElement('td', $last_product->name);
    }

    function test_a_user_can_search_a_product()
    {
    	//having
        $first_product = factory(Product::class)->create(['name' => 'Alka']);
        $products = factory(Product::class)->times(15)->create();
        $last_product = factory(Product::class)->create(['name' => 'Acetaminofen']);

        $this->actingAs($this->defaultUser())
        ->visit(route('products.index'))
        ->see('Productos')
        ->type('alka', 'name')
        ->press('Buscar')
        ->seeInElement('td', $first_product->name);

    }
}
