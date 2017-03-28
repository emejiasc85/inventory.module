<?php
namespace EmejiasInventory\Entities;

class Order extends Entity
{
    protected $fillable = [
    	'delivery',
    	'status',
    	'user_id',
    	'provider_id',
    	'total',
    	'order_type_id',
    	'priority'
    ];

    public function getEditUrlAttribute()
    {
    	return route('orders.edit', $this);
    }
}
