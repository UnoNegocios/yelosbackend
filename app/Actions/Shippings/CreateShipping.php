<?php

namespace App\Actions\Shippings;

use App\Models\Shipping;
use App\Models\ShippingDetail;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;


Class CreateShipping{

    public static function create($data){
         $shipping = Shipping::create(
               $data
           );
            foreach($data['shipping_details'] as $key => $shipping_detail){ 
                $shipping_detail['shipping_id'] = $shipping->id;
                ShippingDetail::create(
                    $shipping_detail
                );
                $invoice = Quotation::findOrFail($shipping_detail['sale_id']);
                $invoice->invoice = $shipping_detail['invoice'];
                $invoice->save();

            }
    }

    public static function bulkCreate($data){
        foreach ($data as $key => $value){
         $shipping = Shipping::create(
               $value
           );
            foreach($value['shipping_details'] as $key => $shipping_detail){ 
                $shipping_detail['shipping_id'] = $shipping->id;
                ShippingDetail::create(
                    $shipping_detail
                );
                $invoice = Quotation::findOrFail($shipping_detail['sale_id']);
                $invoice->invoice = $shipping_detail['invoice'];
                $invoice->save();

            }
        }
    }
}