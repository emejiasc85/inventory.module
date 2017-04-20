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
                    'name' => 'Pastilla'
                ]);
        $ProductGroup = ProductGroup::create([
                    'name' => 'Medicina'
                ]);
        $UnitMeasure =UnitMeasure::create([
                    'name' => 'Unidad'
                ]);
        $Make = Make::create([
                    'name' => 'PFIZER'
                ]);

        Product::create([
            'id' => 1,
            'name'          => 'Viagra',
            'description'   => 'Pastilla para mejorar el rendimiento masculino',
            'product_presentation_id' => $ProductPresentation->id,
            'product_group_id'  => $ProductGroup->id,
            'unit_measure_id'   => $UnitMeasure->id,
            'make_id'   => $Make->id,
            'minimum_stock'     => 5,
        ]);
        $Make2 = Make::create([
                    'name' => 'BAYER'
                ]);

        Product::create([
            'id' => 2,
            'name'          => 'Alkaselser',
            'description'   => 'Pastilla',
            'product_presentation_id' => $ProductPresentation->id,
            'product_group_id'  => $ProductGroup->id,
            'unit_measure_id'   => $UnitMeasure->id,
            'make_id'   => $Make2->id,
            'minimum_stock'     => 5,
        ]);
    }
}
