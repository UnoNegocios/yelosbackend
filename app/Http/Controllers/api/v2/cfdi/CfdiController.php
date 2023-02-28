<?php

namespace App\Http\Controllers\api\v2\cfdi;

use Illuminate\Http\Request;
use App\Models\Cfdi;
use App\Http\Controllers\Controller;
use App\Http\Resources\cfdi\CfdiResource;
use App\Http\Requests\cfdi\StoreCfdiRequest;
use App\Http\Requests\cfdi\UpdateCfdiRequest;
use Illuminate\Support\Facades\Hash;

class CfdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CfdiResource::collection(Cfdi::all());
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
    public function store(StoreCfdiRequest $request)
    {
        $validated = $request->validated();
        
        $cfdi = Cfdi::create(
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
    public function show(Cfdi $cfdi)
    {
        return new CfdiResource($cfdi);
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
    public function update(UpdateCfdiRequest $request, Cfdi $cfdi)
    {
        $validated = $request->validated();
        $cfdi->update($validated);
        return $cfdi;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cfdi $cfdi)
    {
        $cfdi->delete();
        return response(null, 204);
    }
}
