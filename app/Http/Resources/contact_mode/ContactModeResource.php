<?php

namespace App\Http\Resources\contact_mode;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactModeResource extends JsonResource
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
            'name' => $this->mode
        ];
    }
}
