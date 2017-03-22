<?php

namespace EmejiasInventory\Entities;

class OrderType extends Entity
{
    protected $fillable = [
    	'name',
    	'description'
    ];

    public function getEditUrlAttribute()
    {
    	return route('orders.type.edit', $this);
    }
}
