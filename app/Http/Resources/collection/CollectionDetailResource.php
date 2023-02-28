<?php

namespace App\Http\Resources\collection;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\sale\SaleResource;
use App\Http\Resources\collection\CollectionMinResource;

class CollectionDetailResource extends JsonResource
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
            'amount' => $this->amount,
            'due' => $this->due,
            'new_due' => $this->new_due,
            'sale' => new SaleResource($this->sale),
            'payment_complement' => $this->payment_complement,
            'collection' => new CollectionMinResource($this->collection),
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
          //  'collection' => new CollectionMin$this->amount),
        ];
    }
}
