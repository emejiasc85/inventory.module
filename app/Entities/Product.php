<?php

namespace EmejiasInventory\Entities;

use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;


class Product extends Entity
{

    protected $fillable = [
        'name',
        'slug',
        'price',
        'offer_price',
    	'barcode',
        'make_id',
        'full_name',
    	'description',
        'category_id',
    	'minimum_stock',
    	'unit_measure_id',
        'product_group_id',
        'product_serie_id',
    	'product_presentation_id' ,
    ];

    /* mutators */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
        $this->attributes['slug'] = Str::slug($value);
        //$this->attributes['full_name'] = $value;
    }

    /* relations */

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function serie()
    {
        return $this->belongsTo(ProductSerie::class, 'product_serie_id');
    }

    public function presentation()
    {
        return $this->belongsTo(ProductPresentation::class, 'product_presentation_id');
    }
    public function unit()
    {
        return $this->belongsTo(UnitMeasure::class, 'unit_measure_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /* mutators */

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->presentation->name.' '.$this->make->name;
    }

    public function getUrlAttribute()
    {
        return route('products.show', [$this, $this->slug]);
    }
    public function getEditUrlAttribute()
    {
        return route('products.edit', [$this, $this->slug]);
    }
    public function getAddImgUrlAttribute()
    {
        return route('product.images.create', [$this, $this->slug]);
    }


    /* scopes */

    public function scopeGroups($query)
    {
        return $query->when(request()->filled('product_group_id'), function($q){
            $q->where('product_group_id', request()->product_group_id );
        });
    }

    public function scopePresentation($query)
    {
        return $query->when(request()->filled('product_presentation_id'), function($q){
            $q->where('product_presentation_id', request()->product_presentation_id );
        });
    }

    public function scopeSerie($query)
    {
        return $query->when(request()->filled('product_serie_id'), function($q){
            $q->where('product_serie_id', request()->product_serie_id );
        });
    }



    public function scopeUnit($query)
    {
        return $query->when(request()->filled('unit_measure_id'), function($q){
            $q->where('unit_measure_id', request()->unit_measure_id);
        });
    }

    public function scopeCategory($query)
    {
        return $query->when(request()->filled('category_id'), function($q){
            $q->where('category_id', request()->category_id);
        });
    }
    public function scopeMakes($query)
    {
        return $query->when(request()->filled('make_id'), function($q){
            $q->where('make_id', request()->make_id);
        });
    }
    public function scopeBarcode($query)
    {
        return $query->when(request()->filled('barcode'), function($q){
            $q->where('barcode', request()->barcode);
        });
    }
    public function scopeId($query)
    {
        return $query->when(request()->filled('id'), function($q){
            $q->where('id', request()->id);
        });
    }

    /* methods */

    public function addBarcode()
    {
        if (!request()->has('barcode')) {
            $this->barcode = generateBarcodeNumber($this->id);
            $this->save();
       }
       return $this->barcode;
    }

    public function addToStock()
    {
        if (request()->make_order) {
            request()->merge([
                'user_id'       => auth()->user()->id,
                'priority'      => 'Baja',
                'order_type_id' => 1,
                'commerce_id'   => 1
            ]);

            //create order
            $order = Order::create(request()->all());
            //create detail
            $detail = OrderDetail::create([
                'order_id'       => $order->id,
                'product_id'     => $this->id,
                'lot'            => request()->lot,
                'purchase_price' => request()->purchase_price,
                'sale_price'     => $this->price,
                'due_date'       => request()->due_date
            ]);

            //update order
            $order->sumTotals();
            $order->status = 'Ingresado';
            $order->save();

            //create stocks
            foreach ($order->details as $detail) {
                Stock::create([
                    'stock'           => $detail->lot,
                    'warehouse_id'    => 1,
                    'order_detail_id' => $detail->id
                ]);
            }

        }
    }

    public function orders()
    {
        $details = OrderDetail::where('product_id', $this->id)->whereHas('order', function ($q)
        {
           $q->where('order_type_id', 1)->where('status', 'Ingresado');
        })->get();

        return $details->sum('lot');
    }

    public function sales()
    {

        $details = OrderDetail::where('product_id', $this->id)->whereHas('order', function ($q)
        {
           $q->where('order_type_id', 2)->where('status', 'Ingresado');
        })->get();

        return $details->sum('lot');
    }


    public function stocks()
    {

        $details = Stock::whereHas('detail', function($q){
            $q->where('product_id', $this->id);
        })->get();

        return $details->sum('stock');
    }
}
