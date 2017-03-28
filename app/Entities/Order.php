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
    public function type()
    {
        return $this->belongsTo(OrderType::class, 'order_type_id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    public function getEditUrlAttribute()
    {
    	return route('orders.edit', $this);
    }
    public function scopeId($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('id', $value);
        }
    }
}
