<?php

namespace App\Http\Resources\shopping_detail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\shopping\ShoppingMinResource;

class LatestShoppingDetailPosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'unit_cost' => $this->unit_cost,
            'shopping' => new ShoppingMinResource($this->shopping), 
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
