<?php

namespace App\Http\Resources\sale;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleWithCollectionsResource extends JsonResource
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
            'id' => $this->id
        ];
    }
}
