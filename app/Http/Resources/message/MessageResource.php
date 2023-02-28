<?php

namespace App\Http\Resources\message;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\message_status\MessageStatusResource;

class MessageResource extends JsonResource
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
            'id' => $this->uuid,
            'contents' => $this->contents,
            'name' => $this->name,
            'from' => $this->from,
            'to' => $this->to,
            'direction' => $this->direction,
            'channel' => $this->channel,
            'zenvia_timestamp' => $this->zenvia_timestamp,
            'created_at' => $this->created_at,
            'statuses' => MessageStatusResource::collection($this->messageStatuses)
        ];
    }
}
