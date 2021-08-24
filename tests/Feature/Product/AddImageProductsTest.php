<?php

namespace tests\Feature;

use EmejiasInventory\Entities\{Product, ProductImage};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\FeatureTestCase;

class AddImageProductsTest extends FeatureTestCase
{
    function test_user_can_add_image_to_products()
    {
    	//having
        $stub = __DIR__.'/stubs/picture.svg';
        $name = str_random(8).'.svg';
        $path = sys_get_temp_dir().'/'.$name;
        copy($stub, $path);
        $file = new UploadedFile($path, $name, filesize($path), 'image/png', null, true);
        $product = factory(Product::class)->create();

        //when
        $this->actingAs($this->defaultUser())
        ->visit($product->addImgUrl)
        ->type('new photo', 'description')
        ->type($file, 'img')
        ->press('Agregar');

        //then
        $this->seeInDatabase('product_images', [
            'description' => 'new photo'
        ]);

        $uploaded = ProductImage::first()->img_path;

        $this->assertFileExists(storage_path('app/'.$uploaded));

        Storage::delete($uploaded);
    }
}
