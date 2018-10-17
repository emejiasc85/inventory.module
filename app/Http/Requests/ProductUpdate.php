<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use EmejiasInventory\Rules\UniqueProduct;

class ProductUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = $this->route()->parameter('product');
        return [
            'name'                    => ['required', new UniqueProduct($product->id)],
            'product_presentation_id' => 'required|exists:product_presentations,id',
            'product_group_id'        => 'required|exists:product_groups,id',
            'unit_measure_id'         => 'required|exists:unit_measures,id',
            'make_id'                 => 'required|exists:makes,id',
            'product_serie_id'        => 'required|exists:product_series,id',
            'category_id'             => 'required|exists:categories,id',
            'minimum_stock'           => 'required|numeric|min:0',
            'price'                   => 'required|numeric|min:0',
            'offer_price'             => 'required|numeric|min:0',
            'barcode'                 => 'nullable'
        ];
    }
}
