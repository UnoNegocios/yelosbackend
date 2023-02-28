<?php

namespace App\Http\Resources\company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanySelectorResource extends JsonResource
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
            'razon_social' => $this->razon_social,
            'macro' => $this->macro
        ];
    }
}
