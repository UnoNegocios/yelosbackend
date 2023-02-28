<?php
namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\production\ProductionResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\quotation\QuotationResource;

class OrdersToDispatchFilter
{
    public static function excecute($request)
    {        
        $production = QueryBuilder::for(Quotation::class)

        ->where('production_dispatched', '!=', '1')
        ->orWhereNull('production_dispatched')
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::scope('date_between'),
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
        ->where('status', 'vendido')
        ->paginate($request->itemsPerPage)->appends(request()->query());

        return QuotationResource::collection($production);

    }
}