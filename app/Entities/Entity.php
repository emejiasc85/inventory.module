<?php
namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
	public function scopeName($query)
    {
        return $query->when(request()->has('name'), function($q) {
            $q->where('name', 'LIKE', '%'.request()->name.'%');
        });
    }

}