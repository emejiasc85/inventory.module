<?php
namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
	public function scopeName($query, $value)
    {
        if (trim($value) != '') {
            return $query->where('name', 'LIKE', "%$value%");
        }
    }

}