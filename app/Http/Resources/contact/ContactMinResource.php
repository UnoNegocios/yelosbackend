<?php

namespace App\Http\Resources\contact;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactMinResource extends JsonResource
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
            'name' => $this->name,
            'last' => $this->last,
            'phone' => $this->phone,
            'email' => $this->email,
            'job_position' => $this->job_position,
        ];
    }
}
