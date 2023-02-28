<?php

namespace App\Http\Resources\conversation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\company\CompanySelectorResource;

class ConversationMinResource extends JsonResource
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
            'client' => new CompanySelectorResource($this->company),
            'channel' => $this->channel,
            'channelId' => $this->channelId,
            'latest_message' => $this->messages()->latest()->first()
        ];
    }
}
