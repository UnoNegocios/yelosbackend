<?php

namespace App\Http\Requests\shipping_detail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingDetailRequest extends FormRequest
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
            'sale_id' => '',
            'shipping_id' => '',
            'completed' => '',
            'invoice' => '',
            'pdf' => '',
            'company_id' => '',
            'created_by_user_id' => '',
            'last_updated_by_user_id' => '',
        ];
    }
}
