<?php

namespace EmejiasInventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'barcode' => $this->barcode,
            'make' => new MakeResource($this->make),
            'full_name' => $this->full_name,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'minimum_stock' => $this->minimum_stock,
            'unit' => new UnitResource($this->unit),
            'group' => new GroupResource($this->group),
            'serie' => new SerieResource($this->serie),
            'presentation' => new PresentationResource($this->presentation) ,
            'minimum_stock' => $this->minimum_stock,
            'colors' =>  $this->colors->pluck('id')->toArray()
        ];
    }
}
