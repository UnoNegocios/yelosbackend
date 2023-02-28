<?php

namespace App\Http\Controllers;

use App\Models\ShoppingOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewShoppingOrder")){
            $order = ShoppingOrder::orderBy('updated_at', 'DESC')->get();
        }else{
            $order = ShoppingOrder::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $order;
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
        $order = new ShoppingOrder();
        $order->item_id = $request->item_id;
        $order->quantity = $request->quantity;
        $order->created_by_user_id = $request->created_by_user_id;
        $order->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingOrder  $shoppingOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingOrder $shoppingOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingOrder  $shoppingOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingOrder $shoppingOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingOrder  $shoppingOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingOrder $shoppingOrder)
    {
        $order = ShoppingOrder::findOrFail($request->id);
        $order->item_id = $request->item_id;
        $order->quantity = $request->quantity;
        $order->created_by_user_id = $request->created_by_user_id;
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingOrder  $shoppingOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingOrder $shoppingOrder)
    {
        $order = ShoppingOrder::destroy($request->id);
        return $order;
    }
}
