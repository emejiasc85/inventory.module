<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterExpenseResource extends JsonResource
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
            'created_at' => $this->created_at->format('d-m-Y'),
            'description' => $this->description,
            'amount' => $this->amount
        ];
    }
}
