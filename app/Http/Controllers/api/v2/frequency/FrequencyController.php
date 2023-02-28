<?php

namespace App\Http\Controllers\api\v2\frequency;

use Illuminate\Http\Request;
use App\Models\Frequency;
use App\Http\Controllers\Controller;
use App\Http\Resources\frequency\FrequencyResource;
use App\Http\Requests\frequency\StoreFrequencyRequest;
use App\Http\Requests\frequency\UpdateFrequencyRequest;
use Illuminate\Support\Facades\Hash;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FrequencyResource::collection(Frequency::all());
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
    public function store(StoreFrequencyRequest $request)
    {
        $validated = $request->validated();
        
        $frequency = Frequency::create(
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
    public function show(Frequency $frequency)
    {
        return new FrequencyResource($frequency);
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
    public function update(UpdateFrequencyRequest $request, Frequency $frequency)
    {
        $validated = $request->validated();
        $frequency->update($validated);
        return $frequency;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frequency $frequency)
    {
        $frequency->delete();
        return response(null, 204);
    }
}
