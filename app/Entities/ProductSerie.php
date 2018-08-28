<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductSerie extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = str_slug($value);
    }

    //accesors
    public function getEditUrlAttribute()
    {
    	return route('product_series.edit', $this);
    }

    public function scopeSearch($query)
    {
        return $query->orderByDesc('id')
            ->name();
    }

    public function scopeName($query)
    {
        return $query->when(request()->has('name'), function($q) {
            $q->orWhere('name', 'LIKE', '%'.request()->name.'%');
        });
    }
}
