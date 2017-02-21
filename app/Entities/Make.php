<?php

namespace EmejiasInventory\Entities;
use Illuminate\Support\Str;

class Make extends Entity
{
    protected $fillable = ['name', 'slug', 'logo_path'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getEditUrlAttribute()
    {
    	return route('makes.edit', [$this, $this->slug]);
    }

    public function getLogoFileAttribute()
    {
       return storage_path('app/'.$this->logo_path);
    }


}
