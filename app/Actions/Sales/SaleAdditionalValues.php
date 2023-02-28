<?php

namespace App\Actions\Sales;

use App\Models\Quotation;
use App\Models\Item;
use Illuminate\Support\Carbon;
use App\Actions\Sales\SaleAdditionalValues;

Class SaleAdditionalValues
{
    public static function getSumIva($sales_global){
        $sum = 0;
        foreach($sales_global as $key => $sale) {
            $items = Quotation::findOrFail($sale->id)->quotationItems;
            if($sale->type == 'Serie A'){
                foreach($items as $key => $item) {
                    $sum = $sum + (($item->price*$item->quantity)*0.16);
                }
            }else if($sale->type == 'Serie B'){
                if($sale->created_at > '2022-06-28 00:00:00'){
                    foreach($items as $key => $item) {
                        $sum = $sum + (($item->price*$item->quantity)*0.16);
                    }
                }else{
                    foreach($items as $key => $item) {
                        $sum = $sum + (($item->price*$item->quantity)*0.08);
                    }
                } 
            }
        }
        return $sum;
    }

    public static function getSumTotal($sales_global){
        $sum = 0;
        foreach($sales_global as $key => $sale) {
            $items = Quotation::findOrFail($sale->id)->quotationItems;
            if($sale->type == 'Serie A'){
                foreach($items as $key => $item) {
                    $sum = $sum + (($item->price*$item->quantity)*1.16);
                }
            }else if($sale->type == 'Serie B'){
                if($sale->created_at > '2022-06-28 00:00:00'){
                    foreach($items as $key => $item) {
                        $sum = $sum + (($item->price*$item->quantity)*1.16);
                    }
                }else{
                    foreach($items as $key => $item) {
                        $sum = $sum + (($item->price*$item->quantity)*1.08);
                    }
                } 
            }
        }
        return $sum;
    }

    public static function getSumSubtotal($sales_global){
        $sum = 0;
        foreach($sales_global as $key => $value) {
            $items = Quotation::findOrFail($value->id)->quotationItems;
            foreach($items as $key => $item) {
                $sum = $sum + ($item->price*$item->quantity);
            }
        }
        return $sum;
    }

    public static function getSumPayments($sales_global){
        $sum = 0;
        foreach($sales_global as $key => $value) {
            $sum = $sum + Quotation::findOrFail($value->id)->collectionDetails->sum('amount');
        }
        return $sum;
    }

    public static function getSumPastDueBalance($sales_global){
        $sum = 0;

        foreach($sales_global as $key => $sale_global) {
            $sale = Quotation::findOrFail($sale_global->id);
            $items = $sale->quotationItems;
            $credit_days = $sale->company->credit_days;
            $collections = $sale->collectionDetails->sum('amount');
            $expiration_days = (double)date_diff(Carbon::parse($sale->date),now())->format('%R%a');

            if($credit_days>0 && $credit_days!=null){
                $total = 0;
                if($sale->type == 'Serie A'){
                    foreach($items as $key => $item) {
                        $total = $total + (($item->price*$item->quantity)*1.16);
                    }
                }
                else if($sale->type == 'Serie B'){
                    if($sale->created_at > '2022-06-28 00:00:00'){
                        foreach($items as $key => $item) {
                            $total = $total + (($item->price*$item->quantity)*1.16);
                        }
                    }else{
                        foreach($items as $key => $item) {
                            $total = $total + (($item->price*$item->quantity)*1.08);
                        }
                    } 
                }
                if(($total - $collections) > 0){
                    if($expiration_days>($credit_days*1)){
                        $sum = $sum + $total - $collections;
                    }
                }
            }
        }

        return $sum;
    }

    public static function getPendienteDePago($sales_global){
        $sum = 0;

        foreach($sales_global as $key => $sale_global) {
            $sale = Quotation::findOrFail($sale_global->id);
            $items = $sale->quotationItems;
            $credit_days = $sale->company->credit_days;
            $collections = $sale->collectionDetails->sum('amount');

            if($credit_days<=0 || $credit_days==null){
                $total = 0;
                if($sale->type == 'Serie A'){
                    foreach($items as $key => $item) {
                        $total = $total + (($item->price*$item->quantity)*1.16);
                    }
                }else if($sale->type == 'Serie B'){
                    if($sale->created_at > '2022-06-28 00:00:00'){
                        foreach($items as $key => $item) {
                            $total = $total + (($item->price*$item->quantity)*1.16);
                        }
                    }else{
                        foreach($items as $key => $item) {
                            $total = $total + (($item->price*$item->quantity)*1.08);
                        }
                    } 
                }
                if(($total - $collections) > 0){
                    $sum = $sum + ($total - $collections);
                }
            }
        }

        return $sum;
    }

    public static function getEnCredito($sales_global){
        $sum = 0;

        foreach($sales_global as $key => $sale_global) {
            $sale = Quotation::findOrFail($sale_global->id);
            $items = $sale->quotationItems;
            $credit_days = $sale->company->credit_days;
            $collections = $sale->collectionDetails->sum('amount');
            $expiration_days = (double)date_diff(Carbon::parse($sale->date),now())->format('%R%a');

            if($credit_days>0 && $credit_days!=null){
                $total = 0;
                if($sale->type == 'Serie A'){
                    foreach($items as $key => $item) {
                        $total = $total + (($item->price*$item->quantity)*1.08);
                    }
                }
                else if($sale->type == 'Serie B'){
                    if($sale->created_at > '2022-06-28 00:00:00'){
                        foreach($items as $key => $item) {
                            $total = $total + (($item->price*$item->quantity)*1.16);
                        }
                    }else{
                        foreach($items as $key => $item) {
                            $total = $total + (($item->price*$item->quantity)*1.08);
                        }
                    } 
                }
                if(($total - $collections) > 0){
                    if($expiration_days<=($credit_days*1)){
                        $sum = $sum + ($total - $collections);
                    }
                }
            }
        }

        return $sum;
    }

    public static function getSumUtilities($sales_global){
        $sum = 0;
        foreach($sales_global as $keys => $values) {
            $items = Quotation::findOrFail($values->id)->quotationItems;
            foreach($items as $key => $value) {
                $sum = $sum + (($value->price*$value->quantity) - ($value->cost*$value->quantity));
            }
        }
        return $sum;
    }

    public static function getSumWeight($sales_global){
        $sum = 0;
        foreach($sales_global as $keys => $values) {
            $items = Quotation::findOrFail($values->id)->quotationItems;
            foreach($items as $key => $value) {
                $product = Item::findOrFail($value->item_id);
                if($product->unit_id == 2){
                    $sum = $sum + ($product->weight * $value->quantity);
                }
            }
        }
        return $sum;
    }
    
}


