<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Payroll;
use App\Http\Resources\payroll\PayrollResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Filters\Filter;

class PayrollFilter
{
    public static function execute($request)
    {

        $payroll = QueryBuilder::for(Payroll::class)
        ->allowedFilters([
            'notes',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('user.job_position'),
            AllowedFilter::exact('user.sub_job_position'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between'),


        ])
        ->allowedSorts(
            'imss',
            'infonavit',
            'amount',
            'extra_time',
            'production_award',
            'punctuality_award',
            'performance_award',
            'absence',
            'loan',
            'holidays',
            'prima_vacacional',
            'date',
            'note',
            'created_at',
            'updated_at'
            )
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage)->appends(request()->query());
        return PayrollResource::collection($payroll);
    }
}