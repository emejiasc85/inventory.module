<?php

namespace EmejiasInventory\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use EmejiasInventory\Http\Resources\CommerceResource;
use EmejiasInventory\Http\Resources\UserResource;

class AuditResource extends JsonResource
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
            'created_at'    => $this->created_at->format('d-m-Y'),
            'updated_at'    => $this->created_at->format('d-m-Y'),
            'status'        => $this->status,
            'open'          => $this->status == 'Creado',
            'close'         => $this->status == 'Finalizado',
            'has_details'   => $this->details->count() > 0,
            'total_details' => $this->details->count(),
            'user'          => new UserResource($this->whenLoaded('user')),
            'commerce'      => new CommerceResource($this->whenLoaded('commerce')),
            'details'       => AuditDetailResource::collection($this->whenLoaded('details'))
        ];
    }
}
