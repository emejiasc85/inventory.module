<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;


class Product extends Entity
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'offer_price',
    	'barcode',
        'make_id',
        'full_name',
    	'description',
        'category_id',
    	'minimum_stock',
    	'unit_measure_id',
        'product_group_id',
        'product_serie_id',
    	'product_presentation_id' ,
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['full_name'] = $value;
    }

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_group_id');
    }

    public function serie()
    {
        return $this->belongsTo(ProductSerie::class, 'product_serie_id');
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->presentation->name.' '.$this->make->name;
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
            return $query->where('product_group_id', $value);
        }
    }
    public function scopePresentation($query, $value)
    {
        $list = ProductPresentation::pluck('name', 'id')->toArray();
        if($value != '' && isset($list[$value]))
        {
             return $query->where('product_presentation_id', $value);
        }
    }
    public function scopeUnit($query, $value)
    {
        $list = UnitMeasure::pluck('name', 'id')->toArray();
        if($value != '' && isset($list[$value]))
        {
            return $query->where('unit_measure_id', $value);
        }
    }
    public function scopeMakes($query, $value)
    {
        $list = Make::pluck('name', 'id')->toArray();

        if($value != '' && isset($list[$value]))
        {
            return $query->where('make_id', $value);
        }
    }


    public function scopeBarcode($query, $value)
    {
        if (trim($value) != '') {
            return $query->where('barcode', $value);
        }
    }
    public function scopeId($query, $value)
    {
        if (trim($value) != '') {
            return $query->where('id', $value);
        }
    }
}
