<?php

namespace EmejiasInventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use EmejiasInventory\Rules\ValidGiftCard;

class InvoiceGiftCardStore extends FormRequest
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
            'gift_card_id' => [
                'required',
                'exists:gift_cards,id',
                 new ValidGiftCard
              ]
        ];
    }
}
