<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\{Product,ProductImage};
use Tests\FeatureTestCase;


class ShowProductTest extends FeatureTestCase
{
    function test_user_can_show_product_details()
    {
    	//havin
    	$product = factory(Product::class)->create();
    	$images = factory(ProductImage::class)
    		->times(4)
    		->create(['product_id' => $product->id]);

    	//when
    	$this->actingAs($this->defaultUser())
    		->visit($product->url)
    		->seeInElement('strong', $product->name)
            ->see($product->make->name)
    		->see($product->group->name)
    		->see($product->presentation->name)
    		->see($product->unit->name)
            ->see('Fotos del Producto');
    	foreach ($images as $image) {
    		$this->see($image->description);
    	}

    }
}
