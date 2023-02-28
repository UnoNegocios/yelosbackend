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
            'contact_name' => $this->contact->name,

        ];
    }
}
