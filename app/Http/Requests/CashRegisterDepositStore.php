<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashRegisterDepositStore extends FormRequest
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
            'cash_register_id' => 'required|exists:cash_registers,id',
            'baucher' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'bank' => 'required',
            'account' => 'required',
            'date' => 'required'
        ];
    }
}
