<?php

namespace EmejiasInventory;

use Illuminate\Database\Eloquent\Model;

class auditDetail extends Model {
    protected $fillable = [
        'audit_id',
        'product_id',
        'current_stock',
        'audited_stock',
        'status',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function audit() {
        return $this->belongsTo(Audit::class);
    }

}
