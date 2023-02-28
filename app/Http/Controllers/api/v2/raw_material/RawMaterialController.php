<?php

namespace App\Http\Controllers\api\v2\raw_material;

use Illuminate\Http\Request;
use App\Models\RawMaterial;
use App\Http\Controllers\Controller;
use App\Http\Resources\raw_material\RawMaterialResource;
use App\Http\Requests\raw_material\StoreRawMaterialRequest;
use App\Http\Requests\raw_material\UpdateRawMaterialRequest;
use Illuminate\Support\Facades\Hash;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RawMaterialResource::collection(RawMaterial::all());
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
    public function store(StoreRawMaterialRequest $request)
    {
        $validated = $request->validated();
        
        $raw_material = RawMaterial::create(
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
    public function show(RawMaterial $raw_material)
    {
        return new RawMaterialResource($raw_material);
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
    public function update(UpdateRawMaterialRequest $request, RawMaterial $raw_material)
    {
        $validated = $request->validated();
        $raw_material->update($validated);
        return $raw_material;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawMaterial $raw_material)
    {
        $raw_material->delete();
        return response(null, 204);
    }
}
