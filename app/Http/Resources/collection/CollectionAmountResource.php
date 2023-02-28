<?php

namespace App\Http\Resources\collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionAmountResource extends JsonResource
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
            'amount' => $this->amount,
        ];
    }
}
