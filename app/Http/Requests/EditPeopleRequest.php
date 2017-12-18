<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPeopleRequest extends FormRequest
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
        $people  = $this->route()->parameter('people')->id;
        return [
            'name'        => 'required',
            'nit'         => 'required|unique:people,nit,'.$people->id,
            'email'       => 'nullable|unique:people,email,'.$people->id,
            'address'     => 'required',
            'phone'       => 'nullable',
            'type'        => 'required',
            'birthday'    => 'nullable|date',
            'gender'      => 'nullable',
            'facebook'    => 'nullable',
            'instagram'   => 'nullable',
            'website'     => 'nullable|url',
            'other_phone' => 'nullable',
            'avatar'      => 'nullable',
        ];
    }
}
