<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model {

    protected $fillable = [
        'user_id',
        'commerces_id',
        'status',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
