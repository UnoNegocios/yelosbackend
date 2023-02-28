<?php

namespace App\Http\Controllers\api\v2\collection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Collection;
use App\Http\Resources\collection\CollectionResource;
use Spatie\QueryBuilder\AllowedFilter;

class CollectionFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $collections = QueryBuilder::for(Collection::class)
        ->allowedFilters([
            AllowedFilter::exact('macro'),
            AllowedFilter::exact('payment_method_id'),
            AllowedFilter::exact('invoice'),
            AllowedFilter::exact('amount'),
            'note',
            AllowedFilter::exact('status'),
            //items
           
            AllowedFilter::exact('rejection_id'),
            'rejection_comment',
            AllowedFilter::exact('created_at'),
            AllowedFilter::exact('updated_at'),
            AllowedFilter::exact('bar'),
            AllowedFilter::exact('date'),
            AllowedFilter::exact('type'),
            ///total
            'invoice',
            AllowedFilter::exact('printed'),
            AllowedFilter::exact('due_date'),
            AllowedFilter::exact('invoice_date'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('production_dispatched'),
            AllowedFilter::exact('remission'),
            AllowedFilter::scope('date_between')
        ])
        ->allowedSorts('id', 'company_id', 'contact_id', 'subtotal', 'iva', 'total', 'invoice_date')
        ->where('status', 'collection')
        ->paginate(10)->appends(request()->query());
        return CollectionResource::collection($collections)
        ->additional([
            'values' => [
            'sum_total' => (string)$collections->sum('total'),
            'avg_total' => (string)$collections->avg('total'),
            'sum_iva' => (string)$collections->sum('iva'),
            'avg_iva' => (string)$collections->avg('iva'),
            'sum_subtotal' => (string)$collections->sum('subtotal'),
            'avg_subtotal' => (string)$collections->avg('subtotal'),
        ]]);;
    }
}
