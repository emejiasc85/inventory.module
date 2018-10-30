<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'id'         => $this->id,
            'payment_method_id'         => $this->payment_method_id,
            'voucher'    => $this->voucher,
            'created_at' => $this->created_at->format('d-m-Y'),
            'amount'     => $this->amount,
            'deposit'    => $this->deposit
        ];
    }
}
