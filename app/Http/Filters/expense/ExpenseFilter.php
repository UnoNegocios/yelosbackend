<?php

namespace App\Http\Filters\expense;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Expense;
use App\Http\Resources\expense\ExpenseResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Filters\Filter;

class ExpenseFilter
{
    public static function execute($request)
    {

        $expense = QueryBuilder::for(Expense::class)
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
        return ExpenseResource::collection($expense);
    }
}