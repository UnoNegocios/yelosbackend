<?php

namespace App\Http\Requests\calendar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarRequest extends FormRequest
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
            'company_id' => '',
            'contact_id' => '',
            'activity_id' => '',
            'date' => '',
            'only_date' => '',
            'only_time' => '',
            'description' => '',
            'completed' => '',
            'user_id' => '',
            'lead_id' => '',

            /* NEURIK */

            'result' => '',
            //'abrir venta',
            'created_by_user_id' => '',
            'last_updated_by_user_id' => '',
        ];
    }
}
