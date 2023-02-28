<?php

namespace App\Http\Resources\sale;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\collection\CollectionAmountResource;

class SaleResource extends JsonResource
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
            'total' => $this->total,
            'invoice'=> $this->invoice,
            'invoice_date'=> $this->invoice_date,
            'type' => $this->type
          ];
    }
}
