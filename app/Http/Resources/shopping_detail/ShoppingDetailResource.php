<?php

namespace App\Http\Resources\shopping_detail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\item\ItemMinResource;


class ShoppingDetailResource extends JsonResource
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
            'quantity' => $this->quantity,
            'merma' => $this->merma,
            'unit_cost' => $this->unit_cost,
            'used' => $this->used,
            'item' => new ItemMinResource($this->item),
            //'created_by_user_id' => $this->created_by_user_id,
            //'last_updated_by_user_id' => $this->last_updated_by_user_id,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at

        ];
    }
}
