<?php

namespace App\Http\Requests\production;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionRequest extends FormRequest
{
    /**
     * Determine if the production is authorized to make this request.
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
            'date' => 'date', 
            'created_by_user_id' => 'int',
            'updated_by_user_id' => 'int', 
            'user_id' => 'int',
            'status' => 'string',
            'start_time' => 'string',
            'end_time' => 'string'
        ];
    }
}
