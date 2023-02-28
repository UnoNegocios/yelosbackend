<?php

namespace App\Http\Resources\order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\company\CompanyResource;
use App\Models\Quotation;

class DispatchedSaleOrdersListResource extends JsonResource
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
            'date' => $this->date,
            'company' => new CompanyResource($this->company),
            'items_kg_total' => $this->getSaleTotalWeight()
        ];
    }
}
