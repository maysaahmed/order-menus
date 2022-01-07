<?php

namespace Modules\MenuItems\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'maxQty' => $this->maxQty,
            'price' => $this->price
        ];
    }
}
