<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;


class Product extends Entity
{
    protected $fillable = [
    'name',
    'full_name',
	'description',
	'barcode',
	'product_presentation_id' ,
	'product_group_id',
	'unit_measure_id',
    'make_id',
	'minimum_stock',
	'slug'
    ];


    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }
    public function presentation()
    {
        return $this->belongsTo(ProductPresentation::class, 'product_presentation_id');
    }
    public function unit()
    {
        return $this->belongsTo(UnitMeasure::class, 'unit_measure_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['full_name'] = $value;
    }

    public function getUrlAttribute()
    {
        return route('products.show', [$this, $this->slug]);
    }
    public function getEditUrlAttribute()
    {
        return route('products.edit', [$this, $this->slug]);
    }
    public function getAddImgUrlAttribute()
    {
        return route('product.images.create', [$this, $this->slug]);
    }

    public function scopeGroup($query, $value)
    {
        $list = ProductGroup::pluck('name', 'id')->toArray();
        if($value != '' && isset($list[$value]))
        {
            $query->where('product_group_id', $value);
        }
    }
    public function scopePresentation($query, $value)
    {
        $list = ProductPresentation::pluck('name', 'id')->toArray();
        if($value != '' && isset($list[$value]))
        {
            $query->where('product_presentation_id', $value);
        }
    }
    public function scopeUnit($query, $value)
    {
        $list = UnitMeasure::pluck('name', 'id')->toArray();
        if($value != '' && isset($list[$value]))
        {
            $query->where('unit_measure_id', $value);
        }
    }
    public function scopeMake($query, $value)
    {
        $list = Make::pluck('name', 'id')->toArray();
        if($value != '' && isset($list[$value]))
        {
            $query->where('make_id', $value);
        }
    }


    public function scopeBarcode($query, $value)
    {
        if (trim($value) != '') {
            $query->where('barcode', $value);
        }
    }
}
