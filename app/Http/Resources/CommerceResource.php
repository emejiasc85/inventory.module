<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommerceResource extends JsonResource
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
            'patent_name' => $this->patent_name,
            'patent'      => $this->patent,
            'address'     => $this->address,
            'phone'       => $this->phone,
            'other_phone' => $this->other_phone,
            'nit'         => $this->nit,
            'tax'         => $this->tax,
            'profit'      => $this->profit,
            'logo'        => route('commerces.logo', $this),
            'gift_card'   => route('commerces.gift_card', $this)
        ];
    }
}
