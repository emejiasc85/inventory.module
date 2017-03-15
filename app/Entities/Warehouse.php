<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['name', 'description', 'status'];
}
