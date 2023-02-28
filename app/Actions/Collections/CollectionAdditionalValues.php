<?php

namespace App\Actions\Collections;

use App\Models\Collection;
use Illuminate\Support\Carbon;
use App\Models\Payment_method;
use Illuminate\Support\Arr;

Class CollectionAdditionalValues
{
    public static function getSumCollectionPayments($collections){
        $methods = Payment_method::all();
        $perro = [];
        $sum_a = [];
        $sum_b = [];

        foreach($methods as $key => $value) {
            $sum_b[$key] = 0;
            $sum_a[$key] = 0;
            foreach($collections as $key1 => $collection) {
                //foreach($collection['methods'] as $key2 => $method) {
                    if($collection['payment_method_id'] == $value->id){
                        if($collection['serie']=='Serie A'){
                            $sum_a[$key] = $sum_a[$key] + $collection['collectionDetails']->sum('amount');
                        }
                        else if($collection['serie']=='Serie B'){
                            $sum_b[$key] = $sum_b[$key] + $collection['collectionDetails']->sum('amount');
                        }
                    }
                //}
            }
            $perro[$key]['method'] = $value['method'];
            $perro[$key]['sum_serie_a'] = $sum_a[$key];
            $perro[$key]['sum_serie_b'] = $sum_b[$key];
            $perro[$key]['total'] = $sum_a[$key] + $sum_b[$key];
        }

        //return collect(Arr::flatten($collections->pluck('collectionDetails')))->sum('amount');

        return $perro;
    }
    
}
