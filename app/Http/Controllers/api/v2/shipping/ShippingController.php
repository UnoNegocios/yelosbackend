<?php

namespace App\Http\Controllers\api\v2\shipping;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Http\Controllers\Controller;
use App\Http\Resources\shipping\ShippingResource;
use App\Http\Requests\shipping\StoreShippingRequest;
use App\Http\Requests\shipping\UpdateShippingRequest;
use Illuminate\Support\Facades\Hash;
use App\Actions\Shippings\CreateShipping;
use App\Http\Filters\shipping\ShippingFilter;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ShippingFilter::execute($request);
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
       return CreateShipping::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        return new ShippingResource($shipping);
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
    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
        $validated = $request->validated();
        $shipping->update($validated);
        return $shipping;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return response(null, 204);
    }

    public function filter(Request $request)
    {
        return Shipping::filter($request->all())->get();
    }

    public function bulkCreate(Request $request){
        return CreateShipping::bulkCreate($request->all());
    }
}
