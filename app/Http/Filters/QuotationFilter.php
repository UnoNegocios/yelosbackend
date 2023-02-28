<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\quotation\QuotationResource;
use Spatie\QueryBuilder\AllowedFilter;

class QuotationFilter
{

    public function __construct()
    {

    }

    public static function excecute($request)
    {        
        $sales = QueryBuilder::for(Quotation::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('company_id'),
            AllowedFilter::exact('contact_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('pdf'),
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
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('payment_status')
        ])
        ->allowedSorts('id', 'date', 'contact', 'subtotal', 'iva', 'total', 'Npayments', 'Ndue_balance',
        'Npast_due_balance', 'price_list', 'Npayment_status', 'invoice_date', 'Nbalance_due_date',
        'bar', 'Ndelivery_date', 'type', 'Ninvoice', 'Nremission', 'printed', 'Ninvoice_days', 'Nbalance_due_days',
        'user_id', 'created_at', 'created_by_user_id', 'updated_at', 'last_updated_by_user_id' )
        ->where('status', 'quotation')
        ->paginate($request->itemsPerPage)->appends(request()->query());
        return QuotationResource::collection($sales)
        ->additional([
            'values' => [
            'sum_total' => (string)$sales->sum('total'),
            'avg_total' => (string)$sales->avg('total'),
            'sum_iva' => (string)$sales->sum('iva'),
            'avg_iva' => (string)$sales->avg('iva'),
            'sum_subtotal' => (string)$sales->sum('subtotal'),
            'avg_subtotal' => (string)$sales->avg('subtotal'),
        ]]);;
    }
}