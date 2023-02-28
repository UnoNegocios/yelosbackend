<?php

namespace App\Http\Resources\calendar;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\activity\ActivityResource;
use App\Http\Resources\user\UserLightResource;
use App\Http\Resources\company\CompanyResource;
use App\Http\Resources\contact\ContactResource;
use App\Http\Resources\lead\LeadResource;

class CalendarResource extends JsonResource
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
            'only_date' => $this->only_date,
            'only_time' => $this->only_date,
            'description'=> $this->description,
            'completed' => $this->completed,
            'result' => $this->result,
            'company' => new CompanyResource($this->company),
            'contact' => new ContactResource($this->contact),
            'activity_type' => new ActivityResource($this->activity),
            'user' => new UserLightResource($this->user),
            'lead' => new LeadResource($this->lead),
            'created_by_user_id' => $this->getCreatedByUser(),
            'last_updated_by_user_id' => $this->getLastUpdatedByUser(),
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
