<?php

namespace App\Http\Controllers\api\v1\quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Orders\DispatchQuotationAction;

class DispatchQuotationOrder extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, DispatchQuotationAction $dispatchQuotationAction)
    {
        $dispatchQuotationAction->excecute($request);
    }
}
