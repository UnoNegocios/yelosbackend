<?php

namespace App\Http\Controllers\api\v2\filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Company;
use App\Http\Resources\company\CompanySelectorResource;

class CompanyPredictiveFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $companies = QueryBuilder::for(Company::class)
        ->allowedFilters(
            'name',
            'razon_social',
            'macro',

        )->get();
        return CompanySelectorResource::collection($companies);
    }
}
