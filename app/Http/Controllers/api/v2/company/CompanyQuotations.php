<?php

namespace App\Http\Controllers\api\v2\company;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Resources\quotation\QuotationResource;
use Illuminate\Support\Facades\Log;

class CompanyQuotations extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Log::debug($request);
        $quotations = Company::findOrFail($request->id)->quotations;
        return  QuotationResource::collection($quotations);
    }
}
