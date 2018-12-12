<?php

namespace EmejiasInventory\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use EmejiasInventory\Http\Resources\CommerceResource;

class WarehouseResource extends JsonResource
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
            'description' => $this->description,
            'commerce'    => new CommerceResource($this->whenLoaded('commerce')),
            'status'      => $this->status
        ];
    }
}
