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

    //refactor this
    public function scopeDates($query) {
        return $query->when(trim(request()->from) != '' && trim(request()->to) != '', function ($q)
        {
            $from = Carbon::parse(request()->from)->startOfDay();
            $to   = Carbon::parse(request()->to)->endOfDay();
            $q->whereBetween('created_at', [$from, $to]);
        });
    }

    public function scopeProductId($query) {
        return $query->when(trim(request()->id) != '', function ($q)
        {
            $q->where('product_id', request()->id);
        });
    }

    public function scopeIsOrder($query)
    {
        return $query->whereHas('order', function($q){
            $q->where('order_type_id', 1)->where('status', 'Ingresado');
        });
    }


    public function scopeProductName($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('products.name', 'LIKE', "%$value%");
        }
    }

}
