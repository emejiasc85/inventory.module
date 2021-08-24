<?php

namespace tests\Feature;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\Order;
use EmejiasInventory\Entities\OrderType;
use EmejiasInventory\Entities\People;
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class EditOrdersTest extends FeatureTestCase
{
    function test_user_can_edit_orders()
    {
        //having
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        $this->actingAs($this->defaultUser());
        $order    = factory(Order::class)->create(['order_type_id' => 1]);
        $provider = factory(People::class)->create(['name' => 'Lab. Prominente', 'type' => 'provider']);
        $comerce  = factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);

        //when
        $this->visit($order->editUrl)
        	->select($provider->id, 'people_id')
        	->select('Media', 'priority')
        	->press('Editar');

        //the
        $this->seeInDatabase('orders', [
        	'people_id' => $provider->id,
        	'priority' => 'Media'
        ]);
        $this->see('Pedido editada correctamente');
    }
}
