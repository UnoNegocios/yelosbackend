<?php

namespace App\Http\Resources\item;

use Illuminate\Http\Resources\Json\JsonResource;

class SuperiorItemResource extends JsonResource
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
           'id' => (string)$this->id,
           'name' => $this->name
        ];
    }
}
