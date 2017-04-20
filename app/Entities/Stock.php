<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'stock',
        'order_detail_id',
        'warehouse_id',
        'status'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function detail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function scopeStock($query, $simbol, $field)
    {
        if(trim($simbol) != "" && trim($field) != "")
        {
            $query->where('stock', $simbol, $field);
        }
    }

    public function scopeDueDate($query, $from, $to)
    {
        if(trim($from) != "" && trim($to) != "")
        {
            return $query->whereBetween('order_details.due_date', [$from, $to]);
        }
    }

    public function scopeProductBarcode($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('products.barcode', $field);
        }
    }
    public function scopeProduct($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('products.name', "LIKE", "%$field%");
        }
    }
    public function scopeProductId($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('products.id', $field);
        }
    }
    public function scopeOrder($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('order_details.order_id', $field);
        }
    }



}
