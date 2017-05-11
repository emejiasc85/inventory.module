<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;


class People extends Entity
{
    protected $fillable = [
        'name',
        'nit',
        'address',
        'phone',
        'email',
        'type',
        'people'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getEditUrlAttribute()
    {
        return route('people.edit', [$this, $this->slug]);
    }
}
