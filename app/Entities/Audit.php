<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model {

    protected $fillable = [
        'user_id',
        'commerce_id',
        'status',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeId($query, $value) {
        if (trim($value) != null) {
            return $query->where('id', $value);
        }
    }
    public function details() {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function commerces() {
        return $this->belongsTo(Commerce::class, 'commerce_id');
    }

    public function getUrlAttribute() {
        return route('audit.show', $this);
    }
    public function getEditUrlAttribute() {
        return route('audit.edit', $this);
    }
}
