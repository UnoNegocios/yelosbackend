<?php

namespace App\Http\Controllers\api\v2\filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Quotation;
use App\Http\Resources\sale\SaleWithCollectionsResource;

class SaleWithCollectionsPredictiveFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sales = QueryBuilder::for(Quotation::class)
        ->allowedFilters(
            'id'
        )
        ->whereHas('collectionDetails')
        ->get();
        return SaleWithCollectionsResource::collection($sales);
    }
}
