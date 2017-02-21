<?php

namespace EmejiasInventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductPresentation extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
