<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class People extends Entity
{
    protected $fillable = [
        'name',
        'nit',
        'address',
        'phone',
        'email',
        'type',
        'slug',
        'birthday',
        'gender',
        'facebook',
        'instagram',
        'website',
        'other_phone',
        'avatar',
        'max_credit',
        'partner'
    ];

    protected $dates = ['birthday', 'created_at', 'updated_at'];

    /* muttators */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    /* relations */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /* accesors */
    public function getEditUrlAttribute()
    {
        return route('people.edit', [$this, $this->slug]);
    }

    public function getProfileUrlAttribute()
    {
        return route('people.profile', [$this, $this->slug]);
    }

    public function getAvatarFileAttribute()
    {
       return storage_path('app/'.$this->avatar);
    }

    public function getTagsIdAttribute()
    {
        return $this->tags()->pluck('tag_id')->toArray();
    }



    public function getPurchasesAttribute()
    {
        return $this->orders->where('order_type_id', 2)->where('status', 'Ingresado')->where('credit', false);
    }
    public function getCreditsAttribute()
    {
        return $this->orders->where('order_type_id', 2)->where('status', 'Ingresado')->where('credit', true);
    }

    public function getCurrentCreditAttribute()
    {
        $credits = $this->orders->where('order_type_id', 2)->where('credit', true);

        if ($credits->count() > 0) {
            $payments = 0;
            $c = 0;
            foreach ($credits as $credit) {
                $c = $c + $credit->payments->where('payment_method_id', 4)->sum('amount');
                $payments = $payments + $credit->payments->whereIn('payment_method_id', [6,7])->sum('amount');
            }
            return $c - $payments;
        }

        return 0;

    }


    public function getRestCreditAttribute()
    {
        $credits = $this->orders->where('order_type_id', 2)->where('credit', true);

        if ($credits->count() > 0) {
            $payments = 0;

            foreach ($credits as $credit) {
                $payments = $payments + $credit->payments->sum('amount');
            }

            $credit = $credits->sum('total') - $payments;

            return $this->max_credit - $credit ;
        }
        return $this->max_credit;
    }

    public function scopeSearch($query)
    {
        return $query->id()
            ->nit()
            ->name()
            ->partner()
            ->credit();
    }

    public function scopeId($query)
    {
        return $query->when(request()->has('id'), function($q) {
            $q->where('id', request()->id);
        });
    }

    public function scopeNit($query)
    {

        return $query->when(request()->has('nit'), function($q) {
            $q->where('nit', request()->nit);
        });
    }

    public function scopePartner($query)
    {
        return $query->when(request()->has('partner'), function($q) {
            $q->where('partner', request()->partner);
        });
    }

    public function scopeCredit($query)
    {
        return $query->when(request()->has('credit'), function($q) {
            $q->whereHas('orders', function($q){
                $q->where("credit",  true);
            });
        });

    }

    public function scopeTopCustomers($query, $request)
    {
        $query->select(
            'people.id', 'people.name', 'people.nit', 'people.type', 'people.partner',
            DB::raw('SUM(payments.amount) as payments'),
            DB::raw("((SELECT SUM(orders.total) FROM orders
                WHERE orders.people_id = people.id
                AND orders.order_type_id = 2
                AND orders.status = 'Ingresado'
                GROUP BY orders.people_id)) as total"),
            DB::raw("((SELECT SUM(orders.total) FROM orders
                WHERE orders.people_id = people.id
                AND orders.order_type_id = 2
                AND orders.status = 'Ingresado'
                AND orders.credit = 1
                GROUP BY orders.people_id) - SUM(payments.amount)) as credit")
        )
        ->leftJoin('orders', 'orders.people_id', '=', 'people.id' )
        ->leftJoin('payments', 'payments.order_id', '=', 'orders.id' )
        ->groupBy('people.id', 'people.name', 'people.nit', 'people.type', 'people.partner')
        ->orderBy('total', 'DESC');
        return $query;
    }

}
