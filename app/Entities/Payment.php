<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $fillable = ['order_id', 'voucher', 'amount', 'cash_register_id', 'payment_method_id'];

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function cash_register()
    {
        return $this->belongsTo(CashRegister::class);
    }
}
