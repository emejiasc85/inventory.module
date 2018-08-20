<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'bill',
        'order_id',
        'resolution_id',
        'status'
    ];

    public function resolution()
    {
        return $this->belongsTo(Resolution::class);
    }
}
