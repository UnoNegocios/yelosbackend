<?php

namespace App\Http\Controllers\api\v2\phase;

use Illuminate\Http\Request;
use App\Models\Phase;
use App\Http\Controllers\Controller;
use App\Http\Resources\phase\PhaseResource;
use App\Http\Requests\phase\StorePhaseRequest;
use App\Http\Requests\phase\UpdatePhaseRequest;
use Illuminate\Support\Facades\Hash;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PhaseResource::collection(Phase::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhaseRequest $request)
    {
        $validated = $request->validated();
        
        $phase = Phase::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Phase $phase)
    {
        return new PhaseResource($phase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhaseRequest $request, Phase $phase)
    {
        $validated = $request->validated();
        $phase->update($validated);
        return $phase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phase $phase)
    {
        $phase->delete();
        return response(null, 204);
    }
}
