<?php

namespace App\Http\Resources\company;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\frequency\FrequencyResource;
use App\Http\Resources\type\TypeResource;
use App\Http\Resources\origin\OriginResource;
use App\Http\Resources\phase\PhaseResource;
use App\Http\Resources\status\StatusResource;
use App\Http\Resources\user\UserLightResource;
use App\Http\Resources\cfdi\CfdiResource;
use App\Http\Resources\zone\ZoneResource;
use App\Http\Resources\contact_mode\ContactModeResource;
use App\Http\Resources\payment_method\PaymentMethodResource;
use App\Http\Resources\price_list\PriceListResource;
use App\Http\Resources\contact\ContactResource;



class CompanyDetailResource extends JsonResource
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
            'attributes' => [
                'name' => $this->name,
                'macro' => $this->number,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
                'rfc' => $this->rfc,
                'delivery_address' => $this->delivery_address,
                'credit_days' => $this->credit_days,
                'credit_limit' => $this->credit_limit,
                'bank_account_number' => $this->bank_account_number,
                'delivery_time' => $this->delivery_time,
                'razon_social' => $this->razon_social,
                'special_note' => $this->special_note,               
                'opportunity_area' => $this->opportunity_area,
                'payment_conditions' => $this->payment_conditions,
                'frequency' => new FrequencyResource($this->frequency),
                'company_type' => new TypeResource($this->type),
                'origin'=> new OriginResource($this->origin),
                'phase' => new PhaseResource($this->phase),
                'status' => new StatusResource($this->status),
                'user' => new UserLightResource($this->user),
                'cfdi' => new CfdiResource($this->cfdi),
                'zone' => new ZoneResource($this->zone),
                'contact_mode' => new ContactModeResource($this->contact_mode),
                'payment_method' => new PaymentMethodResource($this->payment_method),
                'price_list' => new PriceListResource($this->price_list),
                'created_by_user_id' => new UserLightResource($this->user),
                'contacts' => ContactResource::collection($this->contacts),
                'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
                'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
                'is_in_production' => $this->is_in_production,
                'payment_method' => new PaymentMethodResource($this->paymentMethod),
                'consumptions' => $this->consumptions,
                'price_list' => new PriceListResource($this->priceList),
                'contact_mode' => new ContactModeResource($this->contactMode),
                'special_conditions' => $this->special_conditions,
                'cfdi_id' => $this->cfdi_id

            ]
        ];
    }
}
