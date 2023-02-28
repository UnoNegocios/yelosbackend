<?php
namespace App\Http\Filters\shopping;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Shopping;
use App\Http\Resources\shopping\ShoppingResource;
use Spatie\QueryBuilder\AllowedFilter;

class ShoppingFilter
{
    public static function execute($request)
    {        
        $shopping = QueryBuilder::for(Shopping::class)
        ->allowedFilters([
            'invoice',
            'notes',
            'pdf',
            'xml',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('provider_id'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('received'),
            AllowedFilter::scope('date'),
            AllowedFilter::scope('created_at'),
            AllowedFilter::scope('updated_at'),
            AllowedFilter::scope('due_date'),
            
            

        ])
        /*->allowedSorts('id', 'date', 'contact', 'subtotal', 'iva', 'total', 'Npayments', 'Ndue_balance',
        'Npast_due_balance', 'price_list', 'Npayment_status', 'invoice_date', 'Nbalance_due_date',
        'bar', 'Ndelivery_date', 'type', 'Ninvoice', 'Nremission', 'printed', 'Ninvoice_days', 'Nbalance_due_days',
        'user_id', 'created_at', 'created_by_user_id', 'updated_at', 'last_updated_by_user_id' )*/
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());

        return ShoppingResource::collection($shopping);

    }
}