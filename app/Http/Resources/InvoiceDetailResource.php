<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class InvoiceDetailResource extends JsonResource
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
            'lot'            => $this->lot,
            'order_id'       => $this->order_id,
            'product'        => new ProductResource($this->product),
            'due_date'       => Carbon::parse($this->due_date)->format('d-m-Y') ,
            'purchase_price' => $this->purchase_price,
            'sale_price'     => $this->sale_price,
            'offer_price'     => $this->offer_price,
            'total_purchase' => $this->total_purchase,
            'total_offer_purchase' => $this->total_offer_purchase,
        ];
    }
}
