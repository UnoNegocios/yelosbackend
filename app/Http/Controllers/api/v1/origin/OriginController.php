<?php

namespace App\Http\Controllers\api\v1\origin;

use App\Models\Origin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Origin::orderBy('updated_at', 'DESC')->get();
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
        $origin = new Origin();
        $origin->name = $request->name;       
        $origin->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Origins  $origins
     * @return \Illuminate\Http\Response
     */
    public function show(Origins $origins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Origins  $origins
     * @return \Illuminate\Http\Response
     */
    public function edit(Origins $origins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Origins  $origins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Origin $origin)
    {
        $origin = Origin::findOrFail($request->id);
        $origin->name = $request->name;
        $origin->save();
        return $origin;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Origins  $origins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $origin = Origin::destroy($request->id);
        return $origin;
    }
}
