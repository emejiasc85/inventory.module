<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'barcode' => 'numeric',
            'minimum_stock' => 'numeric',
            'product_presentation_id' => 'required|exists:product_presentations',
            'product_group_id' => 'required|exists:product_groups',
            'unit_measure_id' => 'required|exists:unit_measures',
        ];
    }
}
