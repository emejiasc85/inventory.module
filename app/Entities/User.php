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
        'name', 'email', 'password', 'role_id', 'slug', 'username', 'api_token'
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
    public function scopeName($query, $value)
    {
        if (trim($value) != '') {
            return $query->where('name', 'LIKE', "%$value%");
        }
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    public function isAudit()
    {
        return $this->role_id == 2;
    }
    public function isSeller()
    {
        return $this->role_id == 3;
    }

    public function isAuthor(Order $order)
    {
        return $this->id == $order->user_id;
    }
}
