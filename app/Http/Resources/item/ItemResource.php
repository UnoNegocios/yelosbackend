<?php

namespace App\Http\Resources\item;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\item\SuperiorItemResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /*
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'macro' => $this->macro,
            'is_published' => $this->is_published,
            'featured' => $this->featured,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'start_promo' => $this->start_promo,
            'end_promo' => $this->end_promo,
            'tax' => $this->tax,
            'tax_type' => $this->tax_type,
            'buy_when_available' => $this->buy_when_available,
            'superior_item' => new SuperiorItemResource($this->item),
            //////////////
            'type' => $this->type,
            'provider_id' => $this->,
            'unit_id' => $this->,
            'cost' => $this->cost,
            'weight' => $this->weight,
            'longitude' => $this->longitude,
            'height' => $this->height,
            'width' => $this->width,
            'discoiunt_price' => $this->discoiunt_price,
            'price' => $this->price,
            'product_type' => $this->product_type,
            'inventory' => 'array',
            'categories' => 'array',
            'images' => $this->images,
            'ideal_inventory'  => $this->ideal_inventory,
            'created_by_user_id' => $this->created_by_user_id,
           
        ]; */
    }
}
