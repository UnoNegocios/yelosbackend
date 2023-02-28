<?php

namespace App\Http\Resources\conversation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\client\ClientSelectorResource;
use App\Http\Resources\message\MessageResource;

class ConversationResource extends JsonResource
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
            'client_picture' => $this->client_picture,
            'client_name' => $this->client_name,
            'client' => new ClientSelectorResource($this->client),
            'channel' => $this->channel,
            'channelId' => $this->channelId,
            'messages' => MessageResource::collection($this->messages)
        ];
    }
}
