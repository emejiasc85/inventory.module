<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashRegisterDeposit extends Model
{
    use SoftDeletes;
    protected $fillable = ['cash_register_id', 'baucher', 'amount', 'bank', 'account', 'date'];

    public function cash_register()
    {
        return $this->belongsTo(CashRegister::class);
    }
}
