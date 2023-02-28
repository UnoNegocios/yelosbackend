<?php

namespace App\Http\Requests\lead;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
            'name' => '',
            'last' => '',
            'phone' => '',
            'email' => '',
            'status' => '',
            'channel' => '',
            'origin_id' => '',
            'conversation_id' => '',
            'funnel_phase_id' => '',
            'user_id' => '',
            'additional_data' => '',
            'interest' => ''
        ];
    }
}
