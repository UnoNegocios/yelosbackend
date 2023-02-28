<?php

namespace App\Http\Resources\shipping;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserMinResource;
use App\Http\Resources\vehicle\VehicleResource;
use App\Models\User;
use App\Http\Resources\shipping_detail\ShippingDetailResource;

class ShippingResource extends JsonResource
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
            'id' => $this->id,
            'date' => $this->date,
            'initial_km' => $this->initial_km,
            'final_km' => $this->final_km,
            'route' => ($this->final_km*1) - ($this->initial_km*1),
            'note' => $this->note,
            'driver' => new UserMinResource($this->driver),
            'vehicle' => new VehicleResource($this->vehicle),
            'created_by_user_id' => new UserMinResource(User::find($this->created_by_user_id)),
            'last_updated_by_user_id' => new UserMinResource(User::find($this->last_updated_by_user_id)),
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
            'shipping_details' => ShippingDetailResource::collection($this->shippingDetail),

        ];
    }

}
