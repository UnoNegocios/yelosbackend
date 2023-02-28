<?php

namespace App\Http\Controllers\api\v2\filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Contact;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\contact\ContactSelectorResource;

class ContactPredictiveFilter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $contacts = QueryBuilder::for(Contact::class)
        ->allowedFilters([
            AllowedFilter::exact('company_id'),
            'name'
            ])
            ->get();
            return ContactSelectorResource::collection($contacts);
    }
}
