<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashRegister extends Model
{
    use SoftDeletes;
    protected $fillable = ['initial_cash', 'user_id', 'status', 'baucher', 'amount'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getSalesAttribute()
    {
        return $this->orders->where('order_type_id', 2)->where('credit', false);
    }
    public function getCreditsAttribute()
    {
        return $this->orders->where('order_type_id', 2)->where('credit', true);
    }

    public function deposits()
    {
        return $this->hasMany(CashRegisterDeposit::class);
    }

    public function getEditUrlAttribute()
    {
        return route('cash.registers.edit', $this->id);
    }
}
