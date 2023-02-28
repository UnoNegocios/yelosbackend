<?php

namespace App\Http\Resources\funnel_phase;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\funnel\FunnelResource;


class FunnelPhaseResource extends JsonResource
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
            'order' => $this->order,
            'time' => $this->time,
            'days' => $this->days,
            'funnel' => new FunnelResource($this->funnel)
        ];
    }
}
