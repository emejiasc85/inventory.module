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
	'minimum_stock',
	'slug'
    ];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['full_name'] = $value;
    }

    public function getEditUrlAttribute()
    {
        return route('products.edit', [$this, $this->slug]);
    }
}
