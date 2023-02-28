<?php

namespace App\Http\Resources\shipping_detail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Http\Resources\sale\SaleShippingResource;
use App\Http\Resources\user\UserMinResource;

class ShippingDetailResource extends JsonResource
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
            'sale' => new SaleShippingResource($this->sale),
            'completed' => $this->completed,
            'invoice' => $this->invoice,
            'pdf' => $this->pdf,
            'created_by_user_id' => new UserMinResource(User::find($this->created_by_user_id)),
            'last_updated_by_user_id' => new UserMinResource(User::find($this->last_updated_by_user_id)),
        ];
    }
}
