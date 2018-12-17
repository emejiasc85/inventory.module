<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
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
            'nit'         => $this->nit,
            'name'        => $this->name,
            'address'     => $this->address,
            'phone'       => $this->phone,
            'email'       => $this->email,
            'type'        => $this->type,
            'slug'        => $this->slug,
            'birthday'    => $this->birthday,
            'gender'      => $this->gender,
            'facebook'    => $this->facebook,
            'instagram'   => $this->instagram,
            'website'     => $this->website,
            'other_phone' => $this->other_phone,
            'avatar'      => $this->avatar,
            'max_credit'  => $this->max_credit,
            'partner'     => $this->partner,
            'rest_credit' => $this->restCredit,
            'total_purchases' => $this->purchases->sum('total'),
            'current_credit' => $this->currentCredit
        ];
    }
}
