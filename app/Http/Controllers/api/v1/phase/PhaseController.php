<?php

namespace App\Http\Controllers\api\v1\phase;

use App\Models\Phase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Phase::orderBy('updated_at', 'DESC')->get();
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
    public function store(Request $request)
    {
        $phase = new Phase();
        $phase->name = $request->name;    
        //$phase->days = $request->days;  
        //$phase->color = $request->color; 
        $phase->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function show(Phase $phase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function edit(Phase $phase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phase $phase)
    {
        $phase = Phase::findOrFail($request->id);
        $phase->name = $request->name;    
        //$phase->days = $request->days;  
        //$phase->color = $request->color; 
        $phase->save();
        return $phase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $phase = Phase::destroy($request->id);
        return $phase;
    }
}
