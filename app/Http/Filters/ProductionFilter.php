<?php
namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Production;
use App\Http\Resources\production\ProductionResource;
use Spatie\QueryBuilder\AllowedFilter;

class ProductionFilter
{
    public static function excecute($request)
    {        
        $production = QueryBuilder::for(Production::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('date'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('updated_by_user_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('status'),
            AllowedFilter::exact('start_time'),
            AllowedFilter::exact('end_time'),



        ])
        /*->allowedSorts('id', 'date', 'contact', 'subtotal', 'iva', 'total', 'Npayments', 'Ndue_balance',
        'Npast_due_balance', 'price_list', 'Npayment_status', 'invoice_date', 'Nbalance_due_date',
        'bar', 'Ndelivery_date', 'type', 'Ninvoice', 'Nremission', 'printed', 'Ninvoice_days', 'Nbalance_due_days',
        'user_id', 'created_at', 'created_by_user_id', 'updated_at', 'last_updated_by_user_id' )*/
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());

        return ProductionResource::collection($production);

    }
}