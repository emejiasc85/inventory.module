<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ['name', 'description'];
}
