<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string', 
            'last' => 'string',
            'email' => 'email', 
            'password' => 'string',
            'status' => 'string',
            'goal_amount' => 'string',
            'comission_percentage' => 'string',
            'phone' => 'string',
            'color' => 'string', 
            'job_position' => 'string',
            'sub_job_position' => 'string',
            'birth_date' => 'string',
            'entry_date' => 'string',
            'departure_date' => 'string',
            'daily_salary' => 'string'
            
        ];
    }
}
