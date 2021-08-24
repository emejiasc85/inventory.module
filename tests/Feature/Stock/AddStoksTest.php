<?php

namespace tests\Feature;

use EmejiasInventory\Entities\{Commerce,Order,User, Warehouse, OrderDetail};
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class AddStoksTest extends FeatureTestCase
{
    function test_on_change_order_status_to_ingresado_add_products_to_stock()
    {
        //having
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        $this->actingAs($this->defaultUser());
        $order = factory(Order::class)->create([
            'status' => 'Solicitado',
            'order_type_id' => 1
        ]);
        $detail = factory(OrderDetail::class)->create([
            'order_id'       => $order->id,
            'lot'            => 1,
            'purchase_price' => 10,
            'sale_price'     => 10,
            'total_purchase' =>10


        ]);
        $provider  = factory(User::class)->create(['name' => 'Lab. Prominente']);
        $comerce   = factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);
        $warehouse = factory(Warehouse::class)->create(['id' => 1]);

        //when
        $this->visit($order->url)
            ->type('Ingresado', 'status')
            ->press('Ingresar');

        //then
        $this->seeInDatabase('stocks', [
            'warehouse_id'    => $warehouse->id,
            'stock'           => $detail->lot,
            'order_detail_id' => $detail->id
        ]);

    }
}
