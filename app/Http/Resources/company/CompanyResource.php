<?php

namespace App\Http\Resources\company;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\frequency\FrequencyResource;
use App\Http\Resources\type\TypeResource;
use App\Http\Resources\origin\OriginResource;
use App\Http\Resources\phase\PhaseResource;
use App\Http\Resources\status\StatusResource;
use App\Http\Resources\user\UserLightResource;

class CompanyResource extends JsonResource
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
                'razon_social' => $this->razon_social,
                'macro' => $this->number,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
                'rfc' => $this->rfc,

                'frequency' => new FrequencyResource($this->frequency),
                'company_type' => new TypeResource($this->type),
                'origin'=> new OriginResource($this->origin),
                'phase' => new PhaseResource($this->phase),
                'status' => new StatusResource($this->status),
                'user' => new UserLightResource($this->user),
                'delivery_address' => $this->delivery_address,
                'address_references' => $this->address_references,
                'delivery_time' => $this->delivery_time,
                'credit_days' => $this->credit_days,

                'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
                'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
                'activity_indicator' => $this->activity_indicator
                
                
                
                /*
                
                
                
                'credit_days' => $this->credit_days,
                'credit_limit' => $this->credit_limit,
                'bank_account_number' => $this->bank_account_number,
                'delivery_time' => $this->delivery_time,
                'cfdi' => new CfdiResource($this->cfdi),

                'razon_social' => $this->razon_social,
                'special_note' => $this->special_note,
        
                
                'opportunity_area' => $this->opportunity_area,
                'payment_conditions' => $this->payment_conditions,
                
                'zone_id' => $this->
                'contact_mode_id' => $this->
                'payment_method_id' => $this->
                'frequency_id' => $this->
                'price_list_id' => $this->
                
                'created_by_user_id' => $this->*/

            ]
        ];
    }
}
