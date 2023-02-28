<?php

namespace App\Http\Resources\shopping;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserLightResource;
use App\Http\Resources\provider\ProviderResource;
use App\Http\Resources\shopping_detail\ShoppingDetailResource;

class ShoppingResource extends JsonResource
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
            'serie' => $this->serie,
            'received' => $this->received,
            'invoice' => $this->invoice,
            'iva' => $this->shoppingDetail->sum('total'),
            //'isr' =>
            'due_date' => $this->due_date,
            'notes' => $this->notes,
            'pdf' => $this->pdf,
            'xml' => $this->xml,
            'shopping_details' => ShoppingDetailResource::collection($this->shoppingDetail),
            'provider' => new ProviderResource($this->provider),
            'created_by_user_id' => $this->getCreatedByUser(),
            'last_updated_by_user_id' => $this->getLastUpdatedByUser(),
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
