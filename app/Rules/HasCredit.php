<?php

namespace EmejiasInventory\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasCredit implements Rule
{
    protected $invoice;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
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

        if ($this->invoice->people->max_credit == null && $value == 0) {

            return true;
        }

        return $value < $this->invoice->people->restCredit;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Excede el credito restante del cliente.';
    }
}
