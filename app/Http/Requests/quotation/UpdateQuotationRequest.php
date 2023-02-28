<?php

namespace App\Http\Requests\quotation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationRequest extends FormRequest
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
            'user_id' => '',
            'subtotal' => '', 
            'pdf' => '',
            'note' => '',
            'contact_id' => '',
            'rejection_id' => '',
            'rejection_comment' => '',
            'status' => '', 
            'invoice_date' => '',
            'due_date' => '',
            'production_dispatched' => '',
            'date' => '',
            'bar' => '',
            'type' => '',
            'iva' => '',
            'total' => '',
            'invoice' => '',
            'printed' => '',
            'created_by_user_id' => '',
            'last_updated_by_user_id' => '',
        ];
    }
}
