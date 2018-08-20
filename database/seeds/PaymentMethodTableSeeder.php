<?php

use Illuminate\Database\Seeder;
use EmejiasInventory\Entities\PaymentMethod;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create(['name' => 'Efectivo']);
        PaymentMethod::create(['name' => 'Tarjeta']);
        PaymentMethod::create(['name' => 'Cheque']);
        PaymentMethod::create(['name' => 'Credito']);
        PaymentMethod::create(['name' => 'Gift Card']);
        PaymentMethod::create(['name' => 'Abono a credito']);
    }
}
