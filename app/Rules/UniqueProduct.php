<?php

namespace EmejiasInventory\Rules;

use Illuminate\Contracts\Validation\Rule;
use EmejiasInventory\Entities\Product;

class UniqueProduct implements Rule
{
    protected $product_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($product_id = 0)
    {
        $this->product_id = $product_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $products = Product::query()
            ->make()
            ->unitId()
            ->serieId()
            ->presentationId()
            ->groupId()
            ->categoryId()
            ->where('id', '!=', $this->product_id)
            ->get();
        return $products->count() > 0 ? false:true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe un producto con estas caracteristicas';
    }
}
