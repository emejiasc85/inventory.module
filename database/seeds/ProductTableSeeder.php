<?php

use EmejiasInventory\Entities\Make;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\ProductGroup;
use EmejiasInventory\Entities\ProductPresentation;
use EmejiasInventory\Entities\UnitMeasure;
use Illuminate\Database\Seeder;
use EmejiasInventory\Entities\Category;
use EmejiasInventory\Entities\ProductSerie;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category            = Category::create(['name'            => 'Ropa de niña']);
        $serie               = ProductSerie::create(['name'            => '355']);
        $ProductPresentation = ProductPresentation::create(['name' => 'Unidad']);
        $ProductGroup        = ProductGroup::create(['name'        => 'Vestidos']);
        $UnitMeasure         = UnitMeasure::create(['name'         => 'M']);
        $Make                = Make::create(['name'                => 'Kenvel']);

        for ($i=1; $i <= 1; $i++)
        {
            Product::create([
                'id'                      => $i,
                'name'                    => 'Vestido largo',
                'description'             => 'Vestido largo',
                'product_presentation_id' => $ProductPresentation->id,
                'product_group_id'        => $ProductGroup->id,
                'product_serie_id'        => $serie->id,
                'category_id'             => $category->id,
                'unit_measure_id'         => $UnitMeasure->id,
                'make_id'                 => $Make->id,
                'minimum_stock'           => 5,
                'price'                   => 375,
                'offer_price'             => 355,
            ]);

        }

    }
}
