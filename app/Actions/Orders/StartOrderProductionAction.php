<?php

namespace App\Actions\Orders;

use Illuminate\Http\Request;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;


class StartOrderProductionAction
{

    public function __construct()
    {

    }

    public function excecute(Request $request)
    {    
        Quotation::findOrFail($request->id)
        ->update([
            'is_in_production' => 1
        ]);
    }

}