<?php

namespace App\Http\Filters\lead;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Lead;
use App\Http\Resources\lead\LeadResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Filters\Filter;

class LeadFilter
{
    public static function excecute($request)
    {

        $leads = QueryBuilder::for(Lead::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            'name',
            'phone',
            'email',
            AllowedFilter::exact('origin_id'),
            AllowedFilter::exact('funnel_phase_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::scope('created_'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::exact('client.user_id'),
        ])
        ->allowedSorts(
            'name',
        )
        ->orderBy('created_at', 'DESC')
       ->get();
        return LeadResource::collection($leads);
    }
}