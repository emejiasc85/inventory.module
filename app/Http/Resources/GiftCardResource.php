<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GiftCardResource extends JsonResource
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
            'id'            => $this->id,
            'value'         => $this->value,
            'current_value' => $this->current_value,
            'created_at'    => $this->created_at->format('d-m-Y'),
            'status'        => $this->status
        ];
    }
}
