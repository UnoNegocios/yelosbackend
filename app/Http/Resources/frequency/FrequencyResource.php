<?php

namespace App\Http\Resources\frequency;

use Illuminate\Http\Resources\Json\JsonResource;

class FrequencyResource extends JsonResource
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
            'name' => $this->frequency
        ];
    }
}
