<?php

namespace App\Http\Resources\activity;

use Illuminate\Http\Resources\Json\JsonResource;


class ActivityResource extends JsonResource
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
            'name' => $this->type,
            'color' => $this->color
        ];
    }
}
