<?php

namespace App\Http\Controllers\api\v1\shipping;

use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewShippings")){
            $shipping = Shipping::orderBy('date', 'DESC')->where('date', '>=', '2022-03-01')->get();
        }else{
            $shipping = Shipping::where('created_by_user_id', Auth::user()->id)->orderBy('date', 'DESC')->where('date', '>=', '2022-03-01')->get();
        }
        return $shipping;
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
        $shipping = new Shipping();
        $shipping->driver_id = $request->driver_id;
        $shipping->date = $request->date;
        $shipping->vehicle_id = $request->vehicle_id;
        $shipping->initial_km = $request->initial_km;
        $shipping->final_km = $request->final_km;
        $shipping->note = $request->note;
        $shipping->created_by_user_id = $request->created_by_user_id;
        $shipping->last_updated_by_user_id = $request->last_updated_by_user_id;
        $shipping->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $shipping = Shipping::findOrFail($request->id);
        $shipping->driver_id = $request->driver_id;
        $shipping->date = $request->date;
        $shipping->vehicle_id = $request->vehicle_id;
        $shipping->initial_km = $request->initial_km;
        $shipping->final_km = $request->final_km;
        $shipping->note = $request->note;
        $shipping->created_by_user_id = $request->created_by_user_id;
        $shipping->last_updated_by_user_id = $request->last_updated_by_user_id;
        $shipping->save();
        return $shipping;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $shipping = Shipping::destroy($request->id);
        return $shipping;
    }
}
