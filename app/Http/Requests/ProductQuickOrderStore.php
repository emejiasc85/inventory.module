<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductQuickOrderStore extends FormRequest
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
            'price'          => 'nullable|numeric|min:0|required_if:make_order,true',
            'offer_price'    => 'nullable|numeric|min:0|required_if:make_order,true',
            'purchase_price' => 'numeric|min:0|required_if:make_order,true',
            'lot'            => 'numeric|min:0|required_if:make_order,true',
            'people_id'      => 'required_if:make_order,true|exists:people,id'
        ];
    }
}
