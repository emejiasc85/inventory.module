<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Make extends Model
{
    protected $fillable = ['name', 'slug', 'logo_path'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


}
