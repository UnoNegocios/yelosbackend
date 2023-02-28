<?php
namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\production\ProductionResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\quotation\QuotationResource;
use App\Http\Resources\order\DispatchedSaleOrdersListResource;
use Illuminate\Support\Carbon;

class DispatchedOrdersFilter
{
    public static function excecute($request)
    {        
        $production = QueryBuilder::for(Quotation::class)
        ->doesntHave('shippingDetail')
        ->where('status', 'vendido')
        ->where('bar', '!=', 1)
        ->orWhereNull('bar')
        ->where('production_dispatched', '=', 1)
        //->orWhereNull('production_dispatched')
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('company_id'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            'note',
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between'),
        ])
        ->allowedSorts(
            'id',
            'company.name',
            'created_by_user_id',
            'last_updated_by_user_id',
            'created_at',
            'updated_at'
            )
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage);
        //->paginate($request->itemsPerPage)->appends(request()->query());

        return DispatchedSaleOrdersListResource::collection($production);

    }
}

        /*->where(function($query) {
            $query->where('status', 'vendido')
            ->where('bar', '!=', true)
            ->orWhereNull('bar')
            ->where('production_dispatched', '=', true);
            
        })*/