<?php

namespace tests\FeatureTestCase;

use EmejiasInventory\Entities\{Product, ProductImage};
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\FeatureTestCase;

class DeleteProductImagesTest extends FeatureTestCase
{
    function test_a_user_can_delete_a_product_images()
    {
    	//having
        $product 	= factory(Product::class)->create();
        $img_path 	= Storage::putFile('tests', new File(public_path('img/picture.svg')));
        $image 		= factory(ProductImage::class)->create([
        	'product_id' => $product->id,
        	'img_path' => $img_path,
        ]);

        $this->actingAs($this->defaultUser())
        ->visit($product->url)
        ->seeInElement('a', 'Eliminar')
        ->click('Eliminar')
        ->delete("image/delete", [
                '_token'    => csrf_token(),
                'id'        => $image->id
            ]);


        //then
        $this->dontSeeInDatabase('product_images', [
            'product_id' => $product->id,
            'img_path'	=> $img_path
        ]);

        $this->assertFileNotExists(storage_path('app/'.$img_path));
    }
}
