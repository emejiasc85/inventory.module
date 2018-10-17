<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use EmejiasInventory\Rules\UniqueProduct;

class ProductStore extends FormRequest
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
        return [
            'name'                    => ['required', new UniqueProduct()],
            'product_presentation_id' => 'required|exists:product_presentations,id',
            'product_group_id'        => 'required|exists:product_groups,id',
            'unit_measure_id'         => 'required|exists:unit_measures,id',
            'make_id'                 => 'required|exists:makes,id',
            'product_serie_id'        => 'required|exists:product_series,id',
            'category_id'             => 'required|exists:categories,id',
            'minimum_stock'           => 'required|numeric|min:0',
            'barcode'                 => 'nullable',
            'price'                   => 'required|numeric|min:0|required_if:make_order,true',
            'offer_price'             => 'required|numeric|min:0|required_if:make_order,true',
            'purchase_price'          => 'numeric|min:0|required_if:make_order,true',
            'lot'                     => 'numeric|min:0|required_if:make_order,true',
            'people_id'               => 'required_if:make_order,true|exists:people,id'
        ];
    }
}
