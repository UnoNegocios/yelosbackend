<?php

namespace App\Http\Filters\company;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Company;
use App\Http\Resources\company\CompanyResource;
use App\Http\Resources\company\CompanyDetailResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Filters\Filter;
use App\Http\Filters\company\FiltersNameOrRazonSocial;
use App\Http\Filters\SortClientsByTypeName;

class CompanyFilter
{
    public static function execute($request)
    {

        $company = QueryBuilder::for(Company::class)
        ->allowedFilters([
            'name',
            'address',
            'razon_social',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('phone'),
            AllowedFilter::exact('email'),
            AllowedFilter::exact('number'),
            AllowedFilter::exact('rfc'),
            AllowedFilter::exact('bank_account_number'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('type_id'),
            AllowedFilter::exact('phase_id'),
            AllowedFilter::exact('origin_id'),
            AllowedFilter::exact('status_id'),
            AllowedFilter::exact('activity_indicator'),
            AllowedFilter::exact('consumptions.id'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between'),

            AllowedFilter::custom('name_razon_social', new FiltersNameOrRazonSocial)

        ])
        ->allowedSorts(
            'macro',
            'phase',
            'created_at',
            'updated_at',
            'credit_days',
            AllowedSort::custom('type', new SortClientsByTypeName),
            )
        ->orderBy('created_at', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());
        return CompanyDetailResource::collection($company);
    }
}