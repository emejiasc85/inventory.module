<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotes';
    protected $fillable = ['id', 'order_id'];
}
