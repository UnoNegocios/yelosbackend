<?php

namespace App\Http\Controllers\api\v2\origin;

use Illuminate\Http\Request;
use App\Models\Origin;
use App\Http\Controllers\Controller;
use App\Http\Resources\origin\OriginResource;
use App\Http\Requests\origin\StoreOriginRequest;
use App\Http\Requests\origin\UpdateOriginRequest;
use Illuminate\Support\Facades\Hash;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OriginResource::collection(Origin::all());
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
    public function store(StoreOriginRequest $request)
    {
        $validated = $request->validated();
        
        $origin = Origin::create(
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
    public function show(Origin $origin)
    {
        return new OriginResource($origin);
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
    public function update(UpdateOriginRequest $request, Origin $origin)
    {
        $validated = $request->validated();
        $origin->update($validated);
        return $origin;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Origin $origin)
    {
        $origin->delete();
        return response(null, 204);
    }
}
