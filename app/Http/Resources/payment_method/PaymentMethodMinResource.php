<?php

namespace App\Http\Resources\payment_method;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodMinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->method;
    }
}
