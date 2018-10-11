<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ResolutionResource extends JsonResource
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
            'serie'       => $this->serie,
            'from'        => $this->from,
            'to'          => $this->to,
            'resolution'  => $this->resolution,
            'date'        => Carbon::parse($this->date)->format('d-m-Y'),
            'status'      => $this->status,
            'commerce_id' => new CommerceResource($this->whenLoaded('commerce')) ,
        ];
    }
}
