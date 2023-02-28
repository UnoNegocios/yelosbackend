<?php

namespace App\Http\Resources\shopping;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserLightResource;
use App\Http\Resources\provider\ProviderResource;
use App\Http\Resources\shopping_detail\ShoppingDetailResource;

class ShoppingMinResource extends JsonResource
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
            'provider' => new ProviderResource($this->provider),
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
