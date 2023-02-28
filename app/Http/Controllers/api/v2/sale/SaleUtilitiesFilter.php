<?php

namespace App\Http\Controllers\api\v2\sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\QuotationItem;
use App\Http\Resources\quotation\QuotationItemResource;
use Spatie\QueryBuilder\AllowedFilter;

class SaleUtilitiesFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $quotation_items = QueryBuilder::for(QuotationItemItem::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('quotation_id'),
            AllowedFilter::exact('quantity'),
            AllowedFilter::exact('item_id'),
            AllowedFilter::exact('value'),
            AllowedFilter::exact('price'),
            AllowedFilter::exact('cost'),
            AllowedFilter::scope('date_between')
        ])
        ->allowedSorts('id', 'quotation_id', 'quantity', 'item_id', 'value', 'price', 'cost', 'date_between')
        ->where('status', 'vendido')
        //->orWhere('status', 'cancelled')
        ->paginate($request->itemsPerPage)->appends(request()->query());
        return QuotationItemResource::collection($quotation_items)
        /*->additional([
            'values' => [
            'sum_total' => (string)$quotation_items->sum('total'),
            'avg_total' => (string)$quotation_items->avg('total'),
            'sum_iva' => (string)$quotation_items->sum('iva'),
            'avg_iva' => (string)$quotation_items->avg('iva'),
            'sum_subtotal' => (string)$quotation_items->sum('subtotal'),
            'avg_subtotal' => (string)$quotation_items->avg('subtotal'),
        ]]);*/;
    }
}
