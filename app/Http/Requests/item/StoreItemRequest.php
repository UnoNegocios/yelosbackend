<?php

namespace App\Http\Requests\item;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'sku' => '',
            'macro' => '',
            'is_published' => '',
            'featured' => '',
            'short_description' => '',
            'description' => '',
            'start_promo' => '',
            'end_promo' => '',
            'tax' => '',
            'tax_type' => '',
            'buy_when_available' => '',
            'superiorID' => '',
            'weight' => '',

            'type' => '',
            'provider_id' => '',
            'unit_id' => '',
            'cost' => '',
            'weight' => '',
            'longitude' => '',
            'height' => '',
            'width' => '',
            'discoiunt_price' => '',
            'price' => '',
            'product_type' => '',
            'created_by_user_id' => '',

            'code_one' => '',
            'code_two' => '',
            'code_three' => '',
            'price_one' => '',
            'price_two' => '',
            'price_three' => '',
            'price_four' => '',
            'sat_key_code' => '',

            'inventory' => '',
            'categories' => '',
            'images' => '',
            //'variations' => 'array',
            'ideal_inventory' => '',
            'raw_materials' => '',
        ];
    }
}
