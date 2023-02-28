<?php

namespace App\Http\Controllers\api\v2\quotation;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Resources\collection\CollectionDetailResource;

class QuotationPayments extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $payments = Quotation::findOrFail($request->id)->collectionDetails;
        return CollectionDetailResource::collection($payments);
    }
}
