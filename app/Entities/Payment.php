<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $fillable = ['order_id', 'baucher', 'amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
