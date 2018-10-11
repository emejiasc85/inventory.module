<?php

namespace EmejiasInventory\Rules;

use Illuminate\Contracts\Validation\Rule;
use EmejiasInventory\Entities\GiftCard;

class GiftCardCash implements Rule
{
    protected $gift_card;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($gift_card)
    {
        $this->gift_card = $gift_card;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->gift_card > 0 && $value != null)
        {
            if (GiftCard::find($value)->current_value >= $this->gift_card) {
                return true;
            }
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Excede el monto de la tarjeta';
    }
}
