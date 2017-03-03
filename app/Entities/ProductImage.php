<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['description', 'img_path', 'product_id'];

    public function product()
    {
    	return $this->BelongsTo(Product::class);
    }

    public function getImgFileAttribute()
    {
       return storage_path('app/'.$this->img_path);
    }

}
