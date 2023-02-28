<?php

namespace App\Http\Controllers\api\v2\collection;

use Illuminate\Http\Request;
use App\Models\CollectionDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\collection\CollectionDetailResource;
use App\Http\Requests\collection\StoreCollectionDetailRequest;
use App\Http\Requests\collection\UpdateCollectionDetailRequest;
use Illuminate\Support\Facades\Hash;

class CollectionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CollectionDetailResource::collection(CollectionDetail::all());
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
    public function store(StoreCollectionDetailRequest $request)
    {
        $validated = $request->validated();
        
        $collection = CollectionDetail::create(
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
    public function show(CollectionDetail $collection)
    {
        return new CollectionDetailDetailResource($collection);
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
    public function update(UpdateCollectionDetailRequest $request, CollectionDetail $collection)
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
    public function destroy(CollectionDetail $collection)
    {
        $collection->delete();
        return response(null, 204);
    }
}
