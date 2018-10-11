<?php

namespace EmejiasInventory\Rules;

use Illuminate\Contracts\Validation\Rule;
use EmejiasInventory\Entities\GiftCard;

class GiftCardActive implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if (GiftCard::find($value))
        {
            return GiftCard::find($value)->status;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esta tarjeta esta inactiva';
    }
}
