<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CashRegister extends Model
{
    use SoftDeletes;
    protected $fillable = ['initial_cash', 'user_id', 'status', 'baucher', 'amount', 'closing_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invoices()
    {
        return $this->hasMany(Order::class)->where('order_type_id', 2)->with('payments');
    }

    public function open_invoices()
    {
        return $this->hasMany(Order::class)->where('order_type_id', 2)->where('status', 'Creado');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function sales()
    {
        return $this->hasMany(Order::class)->where('order_type_id', 2)->with('payments');
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
        return route('cash.registers.resume', $this->id);
    }

    public function scopeDate($query)
    {
        if (trim(request()->from) != '' && trim(request()->from) != '') {
            $from = Carbon::parse(request()->from)->startOfDay();  //2016-09-29 00:00:00.000000
            $to = Carbon::parse(request()->to)->endOfDay(); //2016-09-29 23:59:59.000000
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopeId($query)
    {
        if (trim(request()->id) != '') {
            return $query->where('id', request()->id);
        }
    }
    public function scopeUser($query, $id)
    {

        if(trim($id) != '')
        {
            $query->where('user_id', $id);
        }
    }

    public function scopeOpen($query)
    {
        return $query->when(request()->has('latest'), function($q) {
            $q->where('status', false);
        });
    }
}
