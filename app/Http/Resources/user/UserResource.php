<?php

namespace App\Http\Resources\user;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\role\RoleResource;
use App\Http\Resources\permission\PermissionResource;

class UserResource extends JsonResource
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
          'name' => $this->name, 
          'last' => $this->last,
          'email' => $this->email, 
          'status' => $this->status,
          'goal_amount' => $this->goal_amount,
          'comission_percentage' => $this->comission_percentage,
          'phone' => $this->phone,
          'color' => $this->color, 
          'job_position' => $this->job_position,
          'sub_job_position' => $this->ussub_job_positioner,
          'birth_date' => $this->birth_date,
          'entry_date' => $this->entry_date,
          'departure_date' => $this->departure_date,
          'daily_salary' => $this->daily_salary,
          'profile_photo_url' => $this->profile_photo_url,
          'email_verified_at' => $this->email_verified_at,
          'permissions' => PermissionResource::collection($this->permissions),
          'roles' => RoleResource::collection($this->roles)
        ];
    }
}
