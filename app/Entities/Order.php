<?php
namespace EmejiasInventory\Entities;

class Order extends Entity
{
    protected $fillable = [
    	//'delivery',
    	'status',
    	'user_id',
    	'people_id',
    	'total',
    	'order_type_id',
    	'priority'
    ];

    protected $date = ['created_at', 'updated_at'];
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
    public function type()
    {
        return $this->belongsTo(OrderType::class, 'order_type_id');
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function getUrlAttribute()
    {
        return route('orders.show', $this);
    }
    public function getUrlBillAttribute()
    {
        return route('bills.details', $this);
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
    public function scopeStatus($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('status', $value);
        }
    }
    public function scopePriority($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('priority', $value);
        }
    }

    public function sumTotals()
    {
        return $this->total = $this->details->sum('total_purchase');
    }

    public function scopeDate($query, $from, $to)
    {
        if(trim($from) != "" && trim($to) != "")
        {
            return $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopeTotal($query, $simbol, $field)
    {
        if(trim($simbol) != "" && trim($field) != "")
        {
            $query->where('total', $simbol, $field);
        }
    }

    public function scopeSales($query, $simbol, $field)
    {
        if(trim($simbol) != "" && trim($field) != "")
        {
            $query->where('totals', $simbol, $field);
        }
    }

    public function scopeUserName($query, $value)
    {
        if (trim($value) != null) {
            return $query->where('users.name', 'LIKE', "%$value%");
        }
    }


}
