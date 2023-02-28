<?php

namespace App\Http\Resources\sale;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserMinResource;

class SalePastDueDaysAverageResource extends JsonResource
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
            'user' => $this->user_id,
            'balance_due_days' => $this->when($this->getBalanceDueDays() > $this->company->credit_days, $this->getBalanceDueDays()),
        ];
    }
}
