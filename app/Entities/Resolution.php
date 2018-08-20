<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    protected $fillable = [
        'serie',
        'from',
        'to',
        'resolution',
        'date',
        'commerce_id',
        'status'
    ];
     protected $dates = ['date', 'created_at', 'updated_at'];

     public function commerce()
     {
        return $this->belongsTo(Commerce::class);
     }

     public function bills()
     {
            return $this->hasMany(Bill::class);
     }

     public function getEditUrlAttribute()
     {
        return route('resolutions.edit', $this);
     }
     public function getReportUrlAttribute()
     {
        return route('resolutions.report', $this);
     }
}
