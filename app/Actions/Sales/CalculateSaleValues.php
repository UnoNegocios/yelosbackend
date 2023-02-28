<?php

namespace App\Actions\Sales;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;


class CalculateSaleValues{

    public static function calculate($quotation)
    {
        Log::debug($quotation);
    }
}