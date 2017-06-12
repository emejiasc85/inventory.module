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
        'slug',
        'birthday',
        'gender',
        'facebook',
        'instagram',
        'website',
        'other_phone',
        'avatar'
    ];

    protected $dates = ['birthday'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function getEditUrlAttribute()
    {
        return route('people.edit', [$this, $this->slug]);
    }

    public function getProfileUrlAttribute()
    {
        return route('people.profile', [$this, $this->slug]);
    }

    public function getAvatarFileAttribute()
    {
       return storage_path('app/'.$this->avatar);
    }
}
