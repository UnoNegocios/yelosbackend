<?php

namespace App\Http\Controllers\api\v2\funnel_phase;

use Illuminate\Http\Request;
use App\Http\Requests\funnel_phase\StoreFunnelPhaseRequest;
use App\Http\Requests\funnel_phase\UpdateFunnelPhaseRequest;
use App\Models\FunnelPhase;
use App\Http\Controllers\Controller;
use App\Http\Filters\funnel_phase\FunnelPhaseFilter;
use App\Http\Resources\funnel_phase\FunnelPhaseSelectorResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\funnel_phase\FunnelPhaseResource;

class FunnelPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return FunnelPhaseFilter::excecute($request);
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
     * @param  \App\Http\Requests\StoreFunnelPhaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFunnelPhaseRequest $request)
    {
        $validated = $request->validated();
        
        $funnel_phase = FunnelPhase::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FunnelPhase  $funnel_phase
     * @return \Illuminate\Http\Response
     */
    public function show(FunnelPhase $funnel_phase)
    {
        return new FunnelPhaseResource($funnel_phase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FunnelPhase  $funnel_phase
     * @return \Illuminate\Http\Response
     */
    public function edit(FunnelPhase $funnel_phase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFunnelPhaseRequest  $request
     * @param  \App\Models\FunnelPhase  $funnel_phase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFunnelPhaseRequest $request, FunnelPhase $funnel_phase)
    {
        $validated = $request->validated();
        
        $funnel_phase->update($validated);
        return response(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunnelPhase  $funnel_phase
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunnelPhase $funnel_phase)
    {
        $funnel_phase->delete();
        return response(null, 204);
    }

}
