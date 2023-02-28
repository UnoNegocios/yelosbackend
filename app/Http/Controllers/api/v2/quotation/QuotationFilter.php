<?php

namespace App\Http\Controllers\api\v2\quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\quotation\QuotationResource;
use Spatie\QueryBuilder\AllowedFilter;

class QuotationFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $quotations = QueryBuilder::for(Quotation::class)
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
            AllowedFilter::scope('date_between')
        ])
        ->allowedSorts('id', 'company_id', 'contact_id', 'subtotal', 'iva', 'total', 'invoice_date')
        ->where('status', 'quotation')
        ->paginate(10)->appends(request()->query());
        return QuotationResource::collection($quotations)
        ->additional([
            'values' => [
            'sum_total' => (string)$quotations->sum('total'),
            'avg_total' => (string)$quotations->avg('total'),
            'sum_iva' => (string)$quotations->sum('iva'),
            'avg_iva' => (string)$quotations->avg('iva'),
            'sum_subtotal' => (string)$quotations->sum('subtotal'),
            'avg_subtotal' => (string)$quotations->avg('subtotal'),
        ]]);;
    }
}
