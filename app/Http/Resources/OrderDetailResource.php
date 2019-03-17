<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'order_id'   => $this->order_id,
            'lot'        => $this->lot,
            'created_at' => $this->created_at->format('d-m-Y'),
            'product'    => new ProductResource($this->whenLoaded('product'))
        ];
    }
}
