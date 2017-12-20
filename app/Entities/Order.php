<?php
namespace EmejiasInventory\Entities;

use Carbon\Carbon;



class Order extends Entity
{
    protected $fillable = [
    	'status',
    	'user_id',
    	'people_id',
    	'total',
    	'order_type_id',
        'priority',
        'credit',
        'cash_register_id'
    ];

    protected $date = ['created_at', 'updated_at'];
    
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
    public function cash_register()
    {
        return $this->belongsTo(CashRegister::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
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

    public function getUrlQuotationAttribute()
    {
        return route('quotes.details', $this);
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
            $from = Carbon::parse($from)->startOfDay();  //2016-09-29 00:00:00.000000
            $to = Carbon::parse($to)->endOfDay(); //2016-09-29 23:59:59.000000
            $query->whereBetween('orders.created_at', [$from, $to]);
        }
    }
    public function scopeCredit($query, $credit)
    {
        if ($credit) {
            $query->where('orders.credit', true);
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
    public function scopePeopleName($query, $value)
    {
        if (trim($value) != null) {
            $query->leftJoin('people', 'people.id', '=', 'orders.people_id' )
                ->where('people.name', 'LIKE', "%$value%");
            return $query;
        }
    }

    public function scopePeopleId($query, $value)
    {
        if (trim($value) != null) {
            $query->leftJoin('people', 'people.id', '=', 'orders.people_id' )
                ->where('people.id', $value);
            return $query;
        }
    }

    public function canRevert()
    {
        if($this->status == 'Ingresado'){
            foreach ($this->details as $detail) {
                $stock = Stock::where('order_detail_id', $detail->id)->first();
                $history = StockHistory::where('stock_id', $stock->id)->get();
                if(sizeof($history) != 0){
                    return false;
                }
            }
        }

        foreach ($this->details as $detail) {
           Stock::where('order_detail_id', $detail->id)->delete();
        }

        return true;
    }


}
