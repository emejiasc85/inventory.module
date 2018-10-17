<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterDepositResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cash_register_id' => $this->cash_register_id,
            'baucher' => $this->baucher,
            'amount' => $this->amount,
            'bank' => $this->bank,
            'account' => $this->account,
            'date' => $this->date
        ];
    }
}
