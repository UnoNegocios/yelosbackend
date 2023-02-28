<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Collection;
use App\Http\Resources\collection\CollectionResource;
use Spatie\QueryBuilder\AllowedFilter;

class CollectionFilter
{
    public static function excecute($request)
    {        
        $collection = QueryBuilder::for(Collection::class)
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
            'note',
            AllowedFilter::exact('created_at'),
            AllowedFilter::exact('updated_at'),
            AllowedFilter::exact('serie'),
            AllowedFilter::scope('methods'),


            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('company.quotation_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('remission'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::exact('collectionDetails.sale_id'),

        ])
        ->allowedSorts('id', 'date', 'contact', 'subtotal', 'iva', 'total', 'Npayments', 'Ndue_balance',
        'Npast_due_balance', 'price_list', 'Npayment_status', 'invoice_date', 'Nbalance_due_date',
        'bar', 'Ndelivery_date', 'type', 'Ninvoice', 'Nremission', 'printed', 'Ninvoice_days', 'Nbalance_due_days',
        'user_id', 'created_at', 'created_by_user_id', 'updated_at', 'last_updated_by_user_id' )
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());

        return CollectionResource::collection($collection);

    }
}