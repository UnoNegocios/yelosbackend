<?php

namespace App\Http\Controllers\api\v2\collection;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Collection;
use App\Http\Resources\collection\TotalIndicatorsResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\CollectionDetail;
use App\Actions\Collections\CollectionAdditionalValues;
use App\Http\Controllers\Controller;

class TotalIndicators extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $collection = QueryBuilder::for(Collection::class)->with('collectionDetails')
        ->where('date', '>=', '2022-01-01')
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('macro'),
            AllowedFilter::exact('payment_method_id'),
            AllowedFilter::exact('company_id'),
            'invoice',
            'amount',
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('pdf'),
            AllowedFilter::exact('collectionDetails.sale_id'),
            'note',
            AllowedFilter::exact('created_at'),
            AllowedFilter::exact('updated_at'),


            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('remission'),
            AllowedFilter::scope('date_between')
        ])
        ->get();
        //->paginate($request->itemsPerPage)->appends(request()->query());

       // $sales_global = $sales->get();
       // $filtered_sales = $sales->paginate($request->itemsPerPage)->appends(request()->query());


       
        return response()->json([
            'values' => CollectionAdditionalValues::getSumCollectionPayments($collection),
        ]);


    }
}
