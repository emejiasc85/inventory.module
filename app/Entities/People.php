<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = [
        'name',
        'nit',
        'address',
        'phone',
        'email',
        'type',
    ];
}
