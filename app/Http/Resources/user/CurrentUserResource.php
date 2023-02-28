<?php

namespace App\Http\Resources\user;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrentUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id' => (string)$this->id,
            'name' => $this->name,
            'last' => $this->last,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'permissions' => $this->permissions,
        ];

    }
}
