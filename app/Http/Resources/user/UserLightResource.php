<?php

namespace App\Http\Resources\user;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLightResource extends JsonResource
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
            'email' => $this->email, 
            'status' => $this->status,
            'phone' => $this->phone,
            'color' => $this->color, 
            'job_position' => $this->job_position,
            'sub_job_position' => $this->ussub_job_positioner,
            'profile_photo_url' => $this->profile_photo_url,
          ];
    }
}
