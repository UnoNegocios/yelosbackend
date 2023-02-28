<?php

namespace App\Http\Filters\funnel_phase;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\FunnelPhase;
use App\Http\Resources\funnel_phase\FunnelPhaseResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Filters\Filter;

class FunnelPhaseFilter
{
    public static function excecute($request)
    {

        $funnelPhase = QueryBuilder::for(FunnelPhase::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('name'),
            AllowedFilter::exact('funnel.id'),
            AllowedFilter::exact('funnel_id')


        ])
        ->orderBy('order', 'ASC')
        ->get();
        return FunnelPhaseResource::collection($funnelPhase);
    }
}