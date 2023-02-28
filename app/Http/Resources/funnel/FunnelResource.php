<?php

namespace App\Http\Resources\funnel;

use Illuminate\Http\Resources\Json\JsonResource;

class FunnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color
        ];
    }
}
