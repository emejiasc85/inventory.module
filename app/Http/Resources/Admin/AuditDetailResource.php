<?php

namespace EmejiasInventory\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use EmejiasInventory\Http\Resources\ProductResource;
use EmejiasInventory\Http\Resources\StockResource;

class AuditDetailResource extends JsonResource
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
            'current_stock' => $this->current_stock,
            'audited_stock' => $this->audited_stock,
            'status'        => $this->status == 'ok' ? true:false,
            'product'       => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
