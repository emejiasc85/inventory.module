<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CashRegisterExpense extends Model
{

    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function cash_register()
    {
       return $this->belongsTo(CashRegister::class);
    }

}
