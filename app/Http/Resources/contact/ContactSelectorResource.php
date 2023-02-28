<?php

namespace App\Http\Resources\contact;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\company\CompanySelectorResource;

class ContactSelectorResource extends JsonResource
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
            'jon_position' => $this->jon_position,
            'company' => new CompanySelectorResource($this->company)
        ];
    }
}
