<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;

class ProductPresentation extends Entity
{
    protected $fillable = ['name', 'description', 'slug'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getEditUrlAttribute()
    {
    	return route('product.presentations.edit', [$this, $this->slug]);
    }
}
