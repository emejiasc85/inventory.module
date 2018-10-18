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
    public function scopePresentationId($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('product_presentations.id', $field);
        }
    }
    public function scopeMakeId($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('makes.id', $field);
        }
    }
    public function scopeGroupId($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('product_groups.id', $field);
        }
    }

    public function scopeOrder($query, $field)
    {
        if(trim($field) != "")
        {
            $query->where('order_details.order_id', $field);
        }
    }

    public function scopeStockFilter($query)
    {
        $query->selectRaw("product_groups.name,  CONCAT(products.name,' (', makes.name,')') as full_name, products.id as id , sum(stock) as stock,   products.price, products.offer_price, products.slug")
            ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
            ->leftJoin('makes', 'makes.id', '=', 'products.make_id' )
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.product_group_id' )
            ->productBarcode(request()->barcode)
            ->product(request()->name)
            ->productId(request()->id)
            ->where('status', true)
            ->groupBy('products.name', 'products.id', 'makes.name', 'products.price', 'products.offer_price', 'products.slug', 'product_groups.name');
        return $query;
    }



}
