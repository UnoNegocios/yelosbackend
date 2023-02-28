<?php

namespace App\Http\Requests\collection;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollectionRequest extends FormRequest
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
            'macro' => '',
            'date' => '',
            'payment_method_id' => '',
            'amount' => '',
            'invoice' => '',
            'note' => '',
            'pdf' => '',
            'created_by_user_id' => '',
            'last_updated_by_user_id' => '',
            'user_id' => '',
            'company_id' => '',
            'remission' => '',
            'methods' => '',
            'serie' => '',
            'payment_complement' => '',
            'salesID' => '',
            'methods' => ''
        ];
    }
}
