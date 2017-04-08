<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable= [
    	'lot',
    	'order_id',
    	'product_id',
    	'due_date',
        'purchase_price',
        'sale_price',
    	'total_purchase',
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function setPurchasePriceAttribute($value)
    {
        $this->attributes['purchase_price'] = $value;
        $this->attributes['total_purchase'] = $this->attributes['lot'] * $this->attributes['purchase_price'];
    }

}
