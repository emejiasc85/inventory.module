<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterResource extends JsonResource
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
            'id'           => $this->id,
            'initial_cash' => $this->initial_cash,
            'user_id'      => $this->user,
            'status'       => $this->status,
            'baucher'      => $this->baucher,
            'amount'       => $this->amount,
            'closing_date' => $this->closing_date
        ];
    }
}
