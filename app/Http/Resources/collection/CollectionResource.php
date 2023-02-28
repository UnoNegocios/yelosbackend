<?php

namespace App\Http\Resources\collection;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\payment_method\PaymentMethodResource;
use App\Http\Resources\user\UserMinResource;
use App\Http\Resources\user\UserLightResource;
use App\Http\Resources\company\CompanyResource;
use App\Http\Resources\collection\CollectionDetailResource;


class CollectionResource extends JsonResource
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
            'date' => $this->date,
            'amount' => $this->amount,
            'invoice' => $this->invoice,
            'note' => $this->note,
            'pdf' => $this->pdf,
            'remission' => $this->remission,
            'macro' => $this->macro,
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
            'details' => CollectionDetailResource::collection($this->collectionDetails),
            'payments' => $this->getCollectionPayments(),
            'created_by_user_id' => $this->getCreatedByUser(),
            'last_updated_by_user_id' => $this->getLastUpdatedByUser(),
            'user' => new UserLightResource($this->user),
            'company' => new CompanyResource($this->company),
            'payment_method' => new PaymentMethodResource($this->paymentMethod),
            'serie' => $this->serie,
            'payment_complement' => $this->payment_complement,
            
            
            ];
    }
}
