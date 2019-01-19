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
            'id'            => $this->id,
            'name'          => $this->name,
            'price'         => $this->price,
            'offer_price'   => $this->offer_price,
            'barcode'       => $this->barcode,
            'full_name'     => $this->full_name,
            'description'   => $this->description,
            'minimum_stock' => $this->minimum_stock,
            'minimum_stock' => $this->minimum_stock,
            'colors'        => $this->colors->pluck('id')->toArray(),
            'unit'          => new UnitResource($this->unit),
            'make'          => new MakeResource($this->make),
            'group'         => new GroupResource($this->group),
            'serie'         => new SerieResource($this->serie),
            'category'      => new CategoryResource($this->category),
            'presentation'  => new PresentationResource($this->presentation) ,
        ];
    }
}
