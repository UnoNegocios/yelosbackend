<?php

namespace App\Http\Requests\company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'address' => '',
            'phone' => '',
            'email' => '',
            'rfc' => '',
            'cfdi_id' => '',
            'razon_social' => '',
            'special_note' => '',
            'phase_id' => '',
            'origin_id' => '',
            'user_id' => '',
            'status_id' => '',
            'delivery_address' => '',
            'credit_days' => '',
            'credit_limit' => '',
            'bank_account_number' => '',
            'delivery_time' => '',
            'address_references' => '',
            'activity_indicator' => '',
            'number' => '',
            'opportunity_area' => '',
            'payment_conditions' => '',
            'type_id' => '',
            'zone_id' => '',
            'contact_mode_id' => '',
            'payment_method_id' => '',
            'frequency_id' => '',
            'price_list_id' => '',  
            'created_by_user_id' => '',
            'consumptions' => '',
            'special_conditions' => '',
        ];
    }
}
