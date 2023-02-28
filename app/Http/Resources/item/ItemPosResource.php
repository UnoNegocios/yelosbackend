<?php

namespace App\Http\Resources\item;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\shopping_detail\ShoppingDetailPosResource;
use App\Http\Resources\shopping_detail\LatestShoppingDetailPosResource;
use App\Http\Resources\shopping_detail\ShoppingDetailResource;

class ItemPosResource extends JsonResource
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
            'name' => $this->name,
            'latestShopping' => new LatestShoppingDetailPosResource($this->latestShoppingDetail->last()),
            'code_one' => $this->code_one,
            'code_two' => $this->code_two,
            'code_three' => $this->code_three,
            'cost' => $this->cost,
            'price' => $this->price,
            //'price_one' => $this->price_one,
            'price_two' => $this->price_two,
            'price_three' => $this->price_three,
            'price_four' => $this->price_four,
            'sat_key_code' => $this->sat_key_code,
            'item_shopping_details' => ShoppingDetailPosResource::collection($this->shoppingDetails)

        ];
    }
}
