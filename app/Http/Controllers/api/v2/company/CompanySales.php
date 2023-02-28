<?php

namespace App\Http\Controllers\api\v2\company;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Resources\quotation\QuotationResource;

class CompanySales extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $quotations = Company::findOrFail($request->company_id)->quotations->where('status', 'vendido');
        return  QuotationResource::collection($quotations);
    }
}
