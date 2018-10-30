<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleUpdate extends FormRequest
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

        $person = $this->route()->parameter('person');
        return [
            'name'        => 'required',
            'nit'         => 'nullable|unique:people,nit,'.$person->id,
            'email'       => 'nullable|email',
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
            'max_credit' => 'nullable|numeric'
        ];
    }
}
