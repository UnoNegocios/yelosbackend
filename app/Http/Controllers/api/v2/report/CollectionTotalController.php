<?php

namespace App\Http\Controllers\api\v2\report;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Collection;
use App\Http\Resources\collection\TotalIndicatorsResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\CollectionDetail;
use App\Actions\Collections\CollectionAdditionalValues;
use App\Http\Controllers\Controller;

class CollectionTotalController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $collection = QueryBuilder::for(CollectionDetail::class)
        //->where('collection.date', '>=', '2022-01-01')
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('collection.company_id'),
            //AllowedFilter::exact('payment_method_id'),
            AllowedFilter::exact('collection.user_id'),
            AllowedFilter::exact('company.user_id'),
            AllowedFilter::exact('sale.type'),
            AllowedFilter::exact('sale.bar'),
            AllowedFilter::exact('company.price_list_id'),
            

            AllowedFilter::exact('created_at'),
            AllowedFilter::exact('updated_at'),


            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('remission'),
            AllowedFilter::scope('collection.date_between')
        ])
        ->get();
        //->paginate($request->itemsPerPage)->appends(request()->query());

       // $sales_global = $sales->get();
       // $filtered_sales = $sales->paginate($request->itemsPerPage)->appends(request()->query());


       
        return response()->json([
            'collections_total_sum' => $collection->sum('amount'),
            'collections_total_avg' => $collection->avg('amount')
        ]);
    }
}
