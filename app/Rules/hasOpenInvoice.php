<?php

namespace EmejiasInventory\Rules;

use Illuminate\Contracts\Validation\Rule;
use EmejiasInventory\Entities\CashRegister;

class hasOpenInvoice implements Rule
{
    protected $cash_register;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($cash_register)
    {
        $this->cash_register = $cash_register;
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
        $cash_regiter = CashRegister::findOrFail($this->cash_register);

        if ($cash_regiter->open_invoices->count() > 0) {
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
        return 'Existen ventas sin finalizar.';
    }
}
