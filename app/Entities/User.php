<?php

namespace EmejiasInventory\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getEditUrlAttribute()
    {
        return route('users.edit', [$this, $this->slug]);
    }
    public function getEditPasswordUrlAttribute()
    {
        return route('users.password.edit', [$this, $this->slug]);
    }
    public function geteditAuthPasswordAttribute()
    {
        return route('auth.password.edit', [$this, $this->slug]);
    }
}
