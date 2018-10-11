<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use EmejiasInventory\Rules\HasCredit;
use EmejiasInventory\Rules\GiftCardActive;
use EmejiasInventory\Rules\GiftCardCash;

class InvoicePaymentUpdate extends FormRequest
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
        $invoice = $this->route()->parameter('invoice');

        return [
            'credit' => [new HasCredit($invoice)],
            'card_voucher' => 'nullable|required_unless:card,0',
            'check_voucher' => 'nullable|required_unless:check,0',
            'gift_card' => 'nullable',
            'gift_card_code' => ['nullable', 'required_unless:gift_card,0', 'exists:gift_cards,id', new GiftCardActive(), new GiftCardCash(request()->gift_card)]
        ];
    }
}
