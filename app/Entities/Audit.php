<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Audit extends Model {

    protected $fillable = [
        'user_id',
        'commerce_id',
        'status',
    ];

    /* relations */

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details() {
        return $this->hasMany(AuditDetail::class, 'audit_id');
    }
    public function commerce() {
        return $this->belongsTo(Commerce::class, 'commerce_id');
    }

    /* scopes */

    public function scopeId($query, $value) {
        if (trim($value) != null) {
            return $query->where('id', $value);
        }
    }

    public function scopeDates($query) {
        return $query->when(trim(request()->from_date) != '' && trim(request()->to_date) != '', function ($q)
        {
            $from = Carbon::parse(request()->from_date)->startOfDay();  //2016-09-29 00:00:00.000000
            $to = Carbon::parse(request()->to_date)->endOfDay(); //2016-09-29 23:59:59.000000
            $q->whereBetween('created_at', [$from, $to]);
        });
    }

    /* methods */

    public function auditAllProducts()
    {
        $stocks = Stock::GroupByProduct()
            ->get();

        foreach ($stocks as  $value)
        {
            AuditDetail::create([
                'audit_id'      => $this->id,
                'product_id'    => $value->id,
                'current_stock' => $value->stock,
                'audited_stock' => 0
            ]);
        }

        return $this;
    }
}
