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
        $query->selectRaw("product_groups.name, unit_measures.name as unit,  CONCAT(products.name,' (', makes.name,')') as full_name, products.id as id , sum(stock) as stock,   products.price, products.offer_price, products.slug")
            ->leftJoin('order_details', 'order_details.id', '=', 'stocks.order_detail_id' )
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id' )
            ->leftJoin('makes', 'makes.id', '=', 'products.make_id' )
            ->leftJoin('unit_measures', 'unit_measures.id', '=', 'products.unit_measure_id' )
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.product_group_id' )
            ->productBarcode(request()->barcode)
            ->product(request()->name)
            ->productId(request()->id)
            ->where('status', true)
            ->groupBy('products.name', 'unit_measures.name',  'products.id', 'makes.name', 'products.price', 'products.offer_price', 'products.slug', 'product_groups.name');
        return $query;
    }

    public function scopeGroupByProduct($query)
    {
        return $query->select('products.id', 'products.name', 'products.slug', 'products.price', 'products.offer_price', 'status')
            ->selectRaw('SUM(stocks.stock) as stock, unit_measures.name as unit, product_series.name as serie, makes.name as make, product_groups.name as product_group, product_presentations.name as presentation')
            ->leftJoin('order_details', 'stocks.order_detail_id', '=', 'order_details.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('makes', 'makes.id', '=', 'products.make_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.product_group_id')
            ->leftJoin('product_series', 'product_series.id', '=', 'products.product_serie_id')
            ->leftJoin('unit_measures', 'unit_measures.id', '=', 'products.unit_measure_id')
            ->leftJoin('product_presentations', 'product_presentations.id', '=', 'products.product_presentation_id')
            ->where('warehouse_id', 1)
            ->where('status', true)
            ->groupBy('products.id', 'products.name', 'products.slug', 'unit_measures.name', 'products.price', 'products.offer_price', 'stocks.status', 'makes.name', 'product_series.name', 'product_groups.name', 'product_presentations.name')
            ->orderBy('products.id');

    }



}
