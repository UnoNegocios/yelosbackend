<?php

namespace App\Http\Resources\shipping_detail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Http\Resources\sale\SaleShippingResource;
use App\Http\Resources\user\UserMinResource;

class ShippingDetailPdf extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->pdf;
    }
}
