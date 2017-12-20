<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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

    public function scopeDate($query, $from, $to)
    {

        if(trim($from) != "" && trim($to) != "")
        {
            $from = Carbon::parse($from)->startOfDay();  //2016-09-29 00:00:00.000000
            $to = Carbon::parse($to)->endOfDay(); //2016-09-29 23:59:59.000000
            $query->whereBetween('created_at', [$from, $to]);
        }
    }
    
    public function scopeId($query, $id)
    {

        if(trim($id) != '')
        {
            $query->where('id', $id);
        }
    }
    public function scopeUser($query, $id)
    {

        if(trim($id) != '')
        {
            $query->where('user_id', $id);
        }
    }


}
