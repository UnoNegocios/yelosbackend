<?php

namespace App\Http\Resources\lead;

use Illuminate\Http\Resources\Json\JsonResource;
Use App\Http\Resources\user\UserMinResource;
use App\Http\Resources\origin\OriginResource;
use App\Http\Resources\funnel_phase\FunnelPhaseResource;
use App\Http\Resources\conversation\ConversationMinResource;

class LeadResource extends JsonResource
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
            'id' =>(string)$this->id,
            'name' => $this->name,
            'last' => $this->last,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => $this->status,
            'channel' => $this->channel,
            'origin' => new OriginResource($this->origin),
            'conversation' => new ConversationMinResource($this->conversation),
            'funnel_phase' => new FunnelPhaseResource($this->funnelPhase),
            'user' => new UserMinResource($this->user),
            'additional_data' => $this->additional_data,
            'interest' => $this->interest,
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
