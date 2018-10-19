<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'full_name'   => $this->full_name,
            'stock'       => $this->stock,
            'price'       => $this->price,
            'offer_price' => $this->offer_price,
            'unit' => $this->unit,

        ];
    }
}
