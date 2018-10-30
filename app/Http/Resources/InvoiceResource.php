<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class InvoiceResource extends JsonResource
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
            'id'             => $this->id,
            'status'         => $this->status,
            'user'           => new UserResource($this->whenLoaded('user')),
            'people'         => new PeopleResource($this->whenLoaded('people')),
            'priority'       => $this->priority,
            'credit'         => $this->credit,
            'cash_register'  => new CashRegisterResource($this->whenLoaded('cash_register')),
            'bill'           => new BillResource($this->bill),
            'created_at'     => Carbon::parse($this->created_at)->format('d-m-y h:m:s'),
            'details'        => InvoiceDetailResource::collection($this->whenLoaded('details')),
            'gift_cards'     => GiftCardResource::collection($this->gift_cards),
            'lot'            => $this->details->sum('lot'),
            'total'          => $this->total ? $this->total:             0,
            'total_offer'    => $this->total_offer ? $this->total_offer: 0,
            'final_total'    => $this->final_total ? $this->final_total: 0,
            'payments'       => number_format($this->payments->whereIn('payment_method_id', [6,7])->sum('amount'),2),
            'current_credit' => $this->payments->where('payment_method_id', 4)->sum('amount') - $this->payments->where('payment_method_id', 6)->sum('amount'),
            'credit_payments' => PaymentResource::collection($this->payments->whereIn('payment_method_id', [6,7])),
            'credit_payment' =>  number_format($this->payments->where('payment_method_id', 4)->sum('amount'),2),
        ];
    }
}
