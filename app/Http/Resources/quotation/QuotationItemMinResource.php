<?php

namespace App\Http\Resources\quotation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\item\ItemMinResource;

class QuotationItemMinResource extends JsonResource
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
            'value' => $this->value,
            'price' => $this->price,
            'cost' => $this->cost,
            'quotation' => $this->quotation->id,
            'item' => new ItemMinResource($this->item),
            'rejection_status' => $this->rejection_status
        ];
    }
}
