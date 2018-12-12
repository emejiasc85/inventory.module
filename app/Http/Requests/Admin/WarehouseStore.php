<?php

namespace EmejiasInventory\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseStore extends FormRequest
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
            'name' => 'required|unique:warehouses,name',
            'description' => 'nullable',
            'commerce_id' => 'required|exists:commerces,id'
        ];
    }
}
