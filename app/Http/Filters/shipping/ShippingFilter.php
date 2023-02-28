<?php
namespace App\Http\Filters\shipping;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Shipping;
use App\Http\Resources\shipping\ShippingResource;
use Spatie\QueryBuilder\AllowedFilter;

class ShippingFilter
{
    public static function execute($request)
    {        
        $shipping = QueryBuilder::for(Shipping::class)
        ->allowedFilters([
            'note',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('driver_id'),
            AllowedFilter::exact('vehicle_id'),
            AllowedFilter::exact('shippingDetail.company_id'),
            AllowedFilter::exact('shippingDetail.sale_id'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_at'),
            AllowedFilter::scope('updated_at'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            
            

        ])
        /*->allowedSorts('id', 'date', 'contact', 'subtotal', 'iva', 'total', 'Npayments', 'Ndue_balance',
        'Npast_due_balance', 'price_list', 'Npayment_status', 'invoice_date', 'Nbalance_due_date',
        'bar', 'Ndelivery_date', 'type', 'Ninvoice', 'Nremission', 'printed', 'Ninvoice_days', 'Nbalance_due_days',
        'user_id', 'created_at', 'created_by_user_id', 'updated_at', 'last_updated_by_user_id' )*/
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());

        return ShippingResource::collection($shipping)->additional(['meta' => [
            'sum' => 'value',
        ]]);

    }
}