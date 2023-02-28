<?php

namespace App\Http\Resources\payroll;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user\UserMinResource;
use App\Models\User;

class PayrollResource extends JsonResource
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
            'date'=> $this->date,
            'user'=> new UserMinResource($this->user),
            'imss'=> $this->imss,
            'infonavit'=> $this->infonavit,
            'amount'=> $this->amount,
            'extra_time'=> $this->extra_time,
            'production_award'=> $this->production_award,
            'punctuality_award'=> $this->punctuality_award,
            'performance_award'=> $this->performance_award,
            'absence'=> $this->absence,
            'notes'=> $this->notes,
            'created_by_user_id'=> new UserMinResource(User::findOrFail($this->created_by_user_id)),
            'last_updated_by_user_id'=> new UserMinResource(User::findOrFail($this->created_by_user_id)),
            'loan'=> $this->loan,
            'holidays'=> $this->holidays,
            'prima_vacacional'=> $this->prima_vacacional,
    
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),

        ];
    }
}
