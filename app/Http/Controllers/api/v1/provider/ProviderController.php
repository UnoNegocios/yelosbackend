<?php

namespace App\Http\Controllers\api\v1\Provider;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Provider::orderBy('updated_at', 'DESC')->get();
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
        $provider = new Provider();
        $provider->name = $request->name;       
        $provider->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $Provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $Provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $Provider)
    {
        $provider = Provider::findOrFail($request->id);
        $provider->name = $request->name; 
        $provider->save();
        return $provider;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $provider = Provider::destroy($request->id);
        return $provider;
    }
}
