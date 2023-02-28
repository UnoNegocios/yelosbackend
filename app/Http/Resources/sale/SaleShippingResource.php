<?php

namespace App\Http\Resources\sale;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleShippingResource extends JsonResource
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
            'company_name' => $this->company->name,
            'contact' => $this->contact,
            'sale_weight' => $this->getSaleTotalWeight(),
            'sale_due_balance' => $this->getDueBalance(),
            
        ];
    }
}
