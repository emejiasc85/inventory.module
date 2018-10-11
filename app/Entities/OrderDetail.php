<?php

namespace EmejiasInventory\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use EmejiasInventory\Traits\OrderDetailTrait;

class OrderDetail extends Model
{
    use  OrderDetailTrait;
    protected $fillable= [
    	'lot',
    	'order_id',
    	'product_id',
    	'due_date',
        'purchase_price',
        'sale_price',
        'offer_price',
    	'total_purchase',
        'total_offer_purchase',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getDueMonthAttribute()
    {
        Carbon::setLocale('es');
        $now = Carbon::now();
        $due = Carbon::parse($this->due_date);
        if (trim($this->due_date) != '' )
        {
            return $now->diffForHumans($due, true);
        }

        return null;
    }

    public function setPurchasePriceAttribute($value)
    {
        $this->attributes['purchase_price'] = $value;
        $this->attributes['total_purchase'] = $this->attributes['lot'] * $this->attributes['purchase_price'];
    }

    public function scopeDate($query, $from, $to)
    {
        if(trim($from) != "" && trim($to) != "")
        {
            return $query->whereBetween('order_details.created_at', [$from, $to]);
        }
    }
    public function scopeProductName($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('products.name', 'LIKE', "%$value%");
        }
    }

}
