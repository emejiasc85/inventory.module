<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'stock_id',
        'order_id',
        'order_detail_id',
        'lot',
    ];
}
