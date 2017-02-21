<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;

class ProductGroup extends Entity
{
    protected $fillable = ['name', 'description', 'slug'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getEditUrlAttribute()
    {
    	return route('product.groups.edit', [$this, $this->slug]);
    }

}
