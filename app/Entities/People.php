<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;


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

    protected $dates = ['birthday'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPurchasesAttribute()
    {
        return $this->orders->where('order_type_id', 2)->where('credit', false);
    }
    public function getCreditsAttribute()
    {
        return $this->orders->where('order_type_id', 2)->where('credit', true);
    }
    
    public function getCurrentCreditAttribute()
    {
        $credits = $this->orders->where('order_type_id', 2)->where('credit', true);

        if ($credits->count() > 0) {
            $payments = 0;

            foreach ($credits as $credit) {
                $payments = $payments + $credit->payments->sum('amount');
            }

            return $credits->sum('total') - $payments;
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

    public function scopeId($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('id', $value);
        }
    }
    
    public function scopeNit($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('nit', $value);
        }
    }
    public function scopePartner($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('partner', $value);
        }
    }
    
    public function scopeCredit($query, $value)
    {
        if (trim($value) != "") {
            return $query->where('partner', $value);
        }
    }
}
