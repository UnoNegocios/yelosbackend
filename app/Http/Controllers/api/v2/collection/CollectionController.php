<?php

namespace App\Http\Controllers\api\v2\collection;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\collection\CollectionResource;
use App\Http\Requests\collection\StoreCollectionRequest;
use App\Http\Requests\collection\UpdateCollectionRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\CollectionFilter;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return CollectionFilter::excecute($request);
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
    public function store(StoreCollectionRequest $request)
    {
        $validated = $request->validated();
        
        $collection = Collection::create(
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
    public function show(Collection $collection)
    {
        return new CollectionResource($collection);
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
    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $validated = $request->validated();
        $collection->update($validated);
        return $collection;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return response(null, 204);
    }
}
