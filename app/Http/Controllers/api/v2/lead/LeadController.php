<?php

namespace App\Http\Controllers\api\v2\lead;

use Illuminate\Http\Request;
use App\Http\Requests\lead\StoreLeadRequest;
use App\Http\Requests\lead\UpdateLeadRequest;
use App\Models\Lead;
use App\Http\Controllers\Controller;
use App\Http\Filters\lead\LeadFilter;
use App\Http\Resources\lead\LeadSelectorResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\lead\LeadResource;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return LeadFilter::excecute($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeadRequest $request)
    {
        $validated = $request->validated();
        
        $lead = Lead::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return new LeadResource($lead);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeadRequest  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $validated = $request->validated();
        
        $lead->update($validated);
        return response(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response(null, 204);
    }

    public function search(Request $request)
    {
        $leads = QueryBuilder::for(Lead::class)
        ->allowedFilters([
            AllowedFilter::exact('lead_id'),
            'name'
            ])
            ->get();
            return LeadSelectorResource::collection($leads);
    }

    public function cursor(Request $request)
    {
        $leads = Lead::where('funnel_phase_id', $request->id)
        ->cursorPaginate(1);
        return $leads;
    }
}
