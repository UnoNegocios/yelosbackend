<?php

namespace App\Http\Controllers\api\v2\sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\quotation\QuotationItemResource;


class SaleItems extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sales = QuotationItem::whereHas('quotation', function (Builder $query) {
            $query->where('status', 'vendido');
        })
        ->where('created_at', '>=', now()->subDays(30)->endOfDay())
        ->orderBy('created_at', 'DESC')
        ->paginate($request->itemsPerPage);
       return QuotationItemResource::collection($sales);
    }

}
