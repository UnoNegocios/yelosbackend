<?php

namespace App\Http\Controllers\api\v1\shopping;

use App\Models\ShoppingDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewShoppingDetail")){
            $shoppingDetail = ShoppingDetail::orderBy('updated_at', 'DESC')->get();
        }else{
            $shoppingDetail = ShoppingDetail::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $shoppingDetail;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoppingDetail = new ShoppingDetail();
        $shoppingDetail->shopping_id = $request->shopping_id; 
        $shoppingDetail->item_id = $request->item_id; 
        $shoppingDetail->quantity = $request->quantity; 
        $shoppingDetail->merma = $request->merma; 
        $shoppingDetail->productionsID = $request->productionsID;
        $shoppingDetail->salesID = $request->salesID;
        $shoppingDetail->unit_cost = $request->unit_cost;
        $shoppingDetail->used = $request->used;
        $shoppingDetail->created_by_user_id = $request->created_by_user_id; 
        $shoppingDetail->last_updated_by_user_id = $request->last_updated_by_user_id; 
        $shoppingDetail->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingDetail  $shoppingDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingDetail $shoppingDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingDetail  $shoppingDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingDetail $shoppingDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingDetail  $shoppingDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingDetail $shoppingDetail)
    {
        $shoppingDetail = ShoppingDetail::findOrFail($request->id);
        $shoppingDetail->shopping_id = $request->shopping_id; 
        $shoppingDetail->item_id = $request->item_id; 
        $shoppingDetail->quantity = $request->quantity; 
        $shoppingDetail->merma = $request->merma; 
        $shoppingDetail->productionsID = $request->productionsID;
        $shoppingDetail->salesID = $request->salesID;
        $shoppingDetail->unit_cost = $request->unit_cost;
        $shoppingDetail->used = $request->used;
        $shoppingDetail->created_by_user_id = $request->created_by_user_id; 
        $shoppingDetail->last_updated_by_user_id = $request->last_updated_by_user_id;
        $shoppingDetail->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingDetail  $shoppingDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $shoppingDetail = ShoppingDetail::destroy($request->id);
        return $shoppingDetail;
    }
}
