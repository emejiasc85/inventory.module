<?php

use EmejiasInventory\Entities\Make;
use EmejiasInventory\Entities\Product;
use EmejiasInventory\Entities\ProductGroup;
use EmejiasInventory\Entities\ProductPresentation;
use EmejiasInventory\Entities\UnitMeasure;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ProductPresentation=  ProductPresentation::create([
                    'name' => 'Cambiar'
                ]);
        $ProductGroup = ProductGroup::create([
                    'name' => 'Cambiar'
                ]);
        $UnitMeasure =UnitMeasure::create([
                    'name' => 'Cambiar'
                ]);
        $Make = Make::create([
                    'name' => 'Cambiar'
                ]);

        for ($i=1; $i < 184; $i++) {

            Product::create([
                'id'                      => $i,
                'name'                    => 'Cambiar',
                'description'             => 'cambiar',
                'product_presentation_id' => $ProductPresentation->id,
                'product_group_id'        => $ProductGroup->id,
                'unit_measure_id'         => $UnitMeasure->id,
                'make_id'                 => $Make->id,
                'minimum_stock'           => 5,
            ]);

        }

    }
}
