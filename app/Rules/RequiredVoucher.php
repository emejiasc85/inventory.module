<?php

namespace EmejiasInventory\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredVoucher implements Rule
{
    protected $amount;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
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
        if ($this->amount > 0)
        {
            return trim($value) != '';
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
        return 'El campo documento es obligatorio.';
    }
}
