<?php

namespace App\Http\Filters\calendar;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Calendar;
use App\Http\Resources\calendar\CalendarResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Filters\Filter;

class CalendarFilter
{
    public static function excecute($request)
    {

        $leads = QueryBuilder::for(Calendar::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            'description',
            AllowedFilter::exact('company_id'),
            AllowedFilter::exact('contact_id'),
            AllowedFilter::scope('activity_id'),
            AllowedFilter::exact('date'),
            AllowedFilter::exact('only_date'),
            AllowedFilter::exact('only_time'),
            AllowedFilter::exact('completed'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('date'),
            AllowedFilter::exact('lead_id'),
            AllowedFilter::exact('status'),

        ])
        ->allowedSorts(
            'name',
        )
        ->orderBy('created_at', 'DESC')
       ->get();
        return CalendarResource::collection($leads);
    }
}