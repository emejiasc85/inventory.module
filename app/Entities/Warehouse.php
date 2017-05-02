<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;

class Warehouse extends Entity
{
    protected $fillable = ['name', 'description', 'status', 'slug', 'commerce_id'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }

    public function getEditUrlAttribute()
    {
    	return route('warehouses.edit', [$this, $this->slug]);
    }
}
