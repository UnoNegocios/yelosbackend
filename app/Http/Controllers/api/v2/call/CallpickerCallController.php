<?php

namespace App\Http\Controllers\api\v2\call;

use Illuminate\Http\Request;
use App\Models\CallpickerCall;
use App\Http\Controllers\Controller;
use App\Http\Resources\call\CallpickerCallResource;
use App\Http\Requests\call\StoreCallpickerCallRequest;
use App\Http\Requests\call\UpdateCallpickerCallRequest;
use Illuminate\Support\Facades\Hash;

class CallpickerCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CallpickerCallResource::collection(CallpickerCall::all());
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
    public function store(StoreCallpickerCallRequest $request)
    {
        $validated = $request->validated();
        
        $call = CallpickerCall::create(
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
    public function show(CallpickerCall $call)
    {
        return new CallpickerCallResource($call);
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
    public function update(UpdateCallpickerCallRequest $request, CallpickerCall $call)
    {
        $validated = $request->validated();
        $call->update($validated);
        return $call;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CallpickerCall $call)
    {
        $call->delete();
        return response(null, 204);
    }
}
