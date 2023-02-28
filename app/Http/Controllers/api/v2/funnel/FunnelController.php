<?php

namespace App\Http\Controllers\api\v2\funnel;

use Illuminate\Http\Request;
use App\Http\Requests\funnel\StoreFunnelRequest;
use App\Http\Requests\funnel\UpdateFunnelRequest;
use App\Models\Funnel;
use App\Http\Controllers\Controller;
use App\Http\Filters\funnel\FunnelFilter;
use App\Http\Resources\funnel\FunnelSelectorResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\funnel\FunnelResource;

class FunnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return FunnelResource::collection(Funnel::all());
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
     * @param  \App\Http\Requests\StoreFunnelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFunnelRequest $request)
    {
        $validated = $request->validated();
        
        $funnel = Funnel::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function show(Funnel $funnel)
    {
        return new FunnelResource($funnel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Funnel $funnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFunnelRequest  $request
     * @param  \App\Models\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFunnelRequest $request, Funnel $funnel)
    {
        $validated = $request->validated();
        
        $funnel->update($validated);
        return response(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funnel  $funnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funnel $funnel)
    {
        $funnel->delete();
        return response(null, 204);
    }
}
