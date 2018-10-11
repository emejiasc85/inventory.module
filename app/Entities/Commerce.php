<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Commerce extends Model
{
    protected $fillable = [
        'id',
    	'name',
    	'patent_name',
    	'patent',
    	'address',
    	'phone',
    	'other_phone',
    	'nit',
    	'tax',
    	'profit',
    	'logo_path',
    	'slug'
    ];


    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getEditUrlAttribute()
	{
		return route('commerces.edit', [$this, $this->slug]);
	}

    public function getLogoFileAttribute()
    {
       return storage_path('app/'.$this->logo_path);
    }

    public function getShowStorageUrlAttribute()
    {
        return Storage::url('app/'.$this->logo_path);
    }
}
