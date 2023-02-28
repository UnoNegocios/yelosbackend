<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\quotation\QuotationResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use App\Models\CollectionDetail;
use App\Actions\Sales\SaleAdditionalValues;
use App\Http\Filters\CompanyName;
use App\Http\Controllers\api\v2\filter\PaymentStatus;
use Spatie\QueryBuilder\Filters\Filter;




class SaleFilter
{
    public static function excecute($request)
    {        
        $sales = QueryBuilder::for(Quotation::class)
        ->where('date', '>=', '2022-01-01')
       /* ->join('companies', 'companies.id', '=', 'company_id')
        ->select('quotations.companies', 'companies.name')
        ->select('quotations.*')
*/
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('status')->default(['vendido','cancelled']),
            AllowedFilter::exact('company_id'),
            AllowedFilter::exact('contact_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('pdf'),
            'note',
            'company.name',
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
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between'),
            AllowedFilter::exact('company.user_id'),
            AllowedFilter::exact('payment_status'),

            //AllowedFilter::custom('payment_status', new PaymentStatus),
        ])
        ->allowedSorts(
            'company.name',
            'id',
            'due_date',
            'date',
            'bar',
            'created_at',
            'updated_at'

        )
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());


        //$sales_global = $sales->get();
        //$filtered_sales = $sales->paginate($request->itemsPerPage)->appends(request()->query());


        
        return QuotationResource::collection($sales);
        /*->additional([
            'values' => [
            'sum_total' => (string)$sales->where('status', 'vendido')->sum('total'),
            'avg_total' => (string)$sales->where('status', 'vendido')->avg('total'),


            'sum_iva' => (string)$sales->where('status', 'vendido')->sum('iva'),
            'avg_iva' => (string)$sales->where('status', 'vendido')->avg('iva'),
            'sum_subtotal' => (string)$sales->where('status', 'vendido')->sum('subtotal'),
            'avg_subtotal' => (string)$sales->where('status', 'vendido')->avg('subtotal'),
            
            'sum_payments' => SaleAdditionalValues::getSumPayments($sales_global),
            'avg_payments' => SaleAdditionalValues::getSumPayments($sales_global)/$sales_global->count(),
            'sum_due_balance' => (string)$sales->sum('total') - SaleAdditionalValues::getSumPayments($sales_global),
            'avg_due_balance' => ((string)$sales->sum('total') - SaleAdditionalValues::getSumPayments($sales_global))/$sales_global->count(),
            'sum_past_due_balance' => SaleAdditionalValues::getSumPastDueBalance($sales_global),
            'avg_past_due_balance' => SaleAdditionalValues::getSumPastDueBalance($sales_global)/$sales_global->count(),
        ]]);;*/
    }


}