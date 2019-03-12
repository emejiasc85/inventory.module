<?php

namespace EmejiasInventory\Http\Resources\Admin\Report;

use Illuminate\Http\Resources\Json\JsonResource;
use EmejiasInventory\Http\Resources\UnitResource;
use EmejiasInventory\Http\Resources\MakeResource;
use EmejiasInventory\Http\Resources\GroupResource;
use EmejiasInventory\Http\Resources\SerieResource;
use EmejiasInventory\Http\Resources\CategoryResource;
use EmejiasInventory\Http\Resources\PresentationResource;

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
            'id'           => $this->id,
            'name'         => $this->full_name,
            'orders'       => $this->orders(),
            'sales'        => $this->sales(),
            'stocks'       => $this->stocks(),
            'unit'         => new UnitResource($this->unit),
            'make'         => new MakeResource($this->make),
            'group'        => new GroupResource($this->group),
            'serie'        => new SerieResource($this->serie),
            'category'     => new CategoryResource($this->category),
            'presentation' => new PresentationResource($this->presentation) ,
        ];
    }
}
