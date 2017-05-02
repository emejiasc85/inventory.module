<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;


class UnitMeasure extends Entity
{
    protected $fillable = ['name', 'slug'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getEditUrlAttribute()
    {
     	return route('unit.measures.edit', [$this, $this->slug]);
    }
}
