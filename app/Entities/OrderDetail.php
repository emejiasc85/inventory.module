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
    	'cost',
    	'total'

    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
