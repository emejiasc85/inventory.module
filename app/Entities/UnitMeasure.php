<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;


class UnitMeasure extends Entity
{
    protected $fillable = ['name', 'slug'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
