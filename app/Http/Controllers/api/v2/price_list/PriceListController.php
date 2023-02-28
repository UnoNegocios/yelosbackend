<?php

namespace App\Http\Controllers\api\v2\price_list;

use Illuminate\Http\Request;
use App\Models\PriceList;
use App\Http\Controllers\Controller;
use App\Http\Resources\price_list\PriceListResource;
use App\Http\Requests\price_list\StorePriceListRequest;
use App\Http\Requests\price_list\UpdatePriceListRequest;
use Illuminate\Support\Facades\Hash;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PriceListResource::collection(PriceList::all());
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
    public function store(StorePriceListRequest $request)
    {
        $validated = $request->validated();
        
        $price_list = PriceList::create(
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
    public function show(PriceList $price_list)
    {
        return new PriceListResource($price_list);
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
    public function update(UpdatePriceListRequest $request, PriceList $price_list)
    {
        $validated = $request->validated();
        $price_list->update($validated);
        return $price_list;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceList $price_list)
    {
        $price_list->delete();
        return response(null, 204);
    }
}
