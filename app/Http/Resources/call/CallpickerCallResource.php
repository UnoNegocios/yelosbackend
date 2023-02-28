<?php

namespace App\Http\Resources\call;

use Illuminate\Http\Resources\Json\JsonResource;

class CallpickerCallResource extends JsonResource
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
            'call_type' => $this->call_type,
            'call_status' => $this->call_status,
            'date' => $this->date,
            'duration' => $this->duration,
            'callpicker_number' => $this->callpicker_number,
            'dialed_number' => $this->dialed_number,
            'answered_by' => $this->answered_by,
            'dialed_by' => $this->dialed_by,
            'records' => $this->records,
            'city' => $this->city,
            'state' => $this->state,
            'record_keys' => $this->record_keys,
            'note' => $this->noteexit,
        ];
    }
}
