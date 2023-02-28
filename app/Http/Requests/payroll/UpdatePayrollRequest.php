<?php

namespace App\Http\Requests\payroll;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollRequest extends FormRequest
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
            'date' => '',
            'user_id' => '',
            'imss' => '',
            'infonavit' => '',
            'amount' => '',
            'extra_time' => '',
            'production_award' => '',
            'punctuality_award' => '',
            'performance_award' => '',
            'absence' => '',
            'notes' => '',
            'created_by_user_id' => '',
            'last_updated_by_user_id' => '',
            'loan' => '',
            'holidays' => '',
            'prima_vacacional' => '',
        ];
    }
}
