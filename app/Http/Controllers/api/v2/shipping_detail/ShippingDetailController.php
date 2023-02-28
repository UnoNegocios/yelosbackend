<?php

namespace App\Http\Controllers\api\v2\shipping_detail;

use Illuminate\Http\Request;
use App\Models\ShippingDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\shipping_detail\ShippingDetailResource;
use App\Http\Requests\shipping_detail\StoreShippingDetailRequest;
use App\Http\Requests\shipping_detail\UpdateShippingDetailRequest;
use Illuminate\Support\Facades\Hash;
use App\Actions\ShippingDetails\CreateNewShippingDetail;
use App\Http\Filters\shipping_detail\ShippingDetailFilter;

class ShippingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ShippingDetailFilter::execute($request);
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
        $new = new CreateNewShippingDetail();
        $new->excecute($request);
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingDetail $shipping_detail)
    {
        return new ShippingDetailResource($shipping_detail);
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
    public function update(UpdateShippingDetailRequest $request, ShippingDetail $shipping_detail)
    {
        $validated = $request->validated();
        $shipping_detail->update($validated);
        return $shipping_detail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingDetail $shipping_detail)
    {
        $shipping_detail->delete();
        return response(null, 204);
    }

    public function filter(Request $request)
    {
        return ShippingDetail::filter($request->all())->get();
    }
}
