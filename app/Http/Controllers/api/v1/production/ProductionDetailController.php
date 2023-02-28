<?php

namespace App\Http\Controllers\api\v1\production;

use App\Models\ProductionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProductionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewShoppings")){
            $detail = ProductionDetail::orderBy('updated_at', 'DESC')->get();
        }else{
            $detail = ProductionDetail::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $detail;
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
        $detail = new ProductionDetail();
        
        $detail->production_id = $request->production_id;
        $detail->item_id = $request->item_id;
        $detail->quantity = $request->quantity;
        $detail->insumos = $request->insumos;
        $detail->salesID = $request->salesID;
        $detail->created_by_user_id = $request->created_by_user_id;
        $detail->last_updated_by_user_id = $request->last_updated_by_user_id;

        $detail->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        $detail = ProductionDetail::findOrFail($request->id);
        
        $detail->production_id = $request->production_id;
        $detail->item_id = $request->item_id;
        $detail->quantity = $request->quantity;
        $detail->insumos = $request->insumos;
        $detail->salesID = $request->salesID;
        $detail->created_by_user_id = $request->created_by_user_id;
        $detail->last_updated_by_user_id = $request->last_updated_by_user_id;
           
        $detail->save();
        return $detail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $detail = ProductionDetail::destroy($request->id);
        return $detail;
    }
}
