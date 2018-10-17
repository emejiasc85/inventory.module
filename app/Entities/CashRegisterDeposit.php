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

    public function scopeCashRegister($query)
    {
        return $query->when(request()->has('cash_register_id'), function($q){
            $q->where('cash_register_id', request()->cash_register_id);
        });
    }
}
