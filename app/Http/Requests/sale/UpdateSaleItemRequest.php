<?php

namespace App\Http\Requests\sale;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleItemRequest extends FormRequest
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
            'quantity' => '',
            'value' => '',
            'price' => '',
            'cost' => '',
            'quotation_id' => '',
            'item_id' => ''
        ];
    }
}
