<?php

namespace App\Http\Resources\message_status;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageStatusResource extends JsonResource
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
            'code' => $this->code,
            'zenvia_timestamp' => $this->zenvia_timestamp
        ];
    }
}
