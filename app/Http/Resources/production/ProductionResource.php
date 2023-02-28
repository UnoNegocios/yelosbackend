<?php

namespace App\Http\Resources\production;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserMinResource;
use App\Http\Resources\user\UserLightResource;


class ProductionResource extends JsonResource
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
           'date' =>$this->date,
           'status' =>$this->status,
           'start_time' =>$this->start_time,
           'end_time' =>$this->end_time,
           'user' => New UserLightResource($this->user),
           'created_by_user_id' => New UserMinResource($this->user),
           'updated_by_user_id' => New UserMinResource($this->user)
        ];
    }
}
