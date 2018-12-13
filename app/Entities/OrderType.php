<?php

namespace EmejiasInventory\Entities;

class OrderType extends Entity
{
    protected $fillable = [
        'name',
        'description'
    ];

    const Order     = 1;
    const Invoice   = 2;
    const Transfer  = 3;
    const Quotation = 4;
    const Credit    = 5;

    public function getEditUrlAttribute()
    {
        return route('orders.type.edit', $this);
    }
}
