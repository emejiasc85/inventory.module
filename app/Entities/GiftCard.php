<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $table = 'gift_cards';
    protected $guarded = [];
    protected $dates = ['updated_at', 'created_at'];

    /* accesors */
    public function scopeId($query)
    {
        return $query->when(request()->has('id'), function ($q) {
            $q->where('id', request()->id);
        });
    }

    public function scopeStatus($query)
    {
        return $query->when(request()->has('status'), function ($q) {
            $q->where('status', request()->status);
        });
    }
}
