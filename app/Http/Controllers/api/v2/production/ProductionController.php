<?php

namespace App\Http\Controllers\api\v2\production;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Http\Controllers\Controller;
use App\Http\Resources\production\ProductionResource;
use App\Http\Requests\production\StoreProductionRequest;
use App\Http\Requests\production\UpdateProductionRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\ProductionFilter;
use App\Actions\Productions\CreateNewProduction;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ProductionFilter::excecute($request);
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
    public function store(Request $request, CreateNewProduction $createNewProduction)
    {
        $createNewProduction->excecute($request);
    
        //return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        return new ProductionResource($production);
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
    public function update(UpdateProductionRequest $request, Production $production)
    {
        $validated = $request->validated();
        $production->update($validated);
        return $production;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        $production->delete();
        return response(null, 204);
    }
}
