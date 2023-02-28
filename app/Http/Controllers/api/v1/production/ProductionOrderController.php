<?php

namespace App\Http\Controllers\api\v1\production;

use App\Models\ProductionOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProductionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewProductionOrders")){
            $order = ProductionOrder::orderBy('updated_at', 'DESC')->get();
        }else{
            $order = ProductionOrder::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
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
        $order = new ProductionOrder();
        $order->item_id = $request->item_id;
        $order->quantity = $request->quantity;
        $order->created_by_user_id = $request->created_by_user_id;
        $order->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductionOrder  $productionOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionOrder $productionOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductionOrder  $productionOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductionOrder $productionOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionOrder  $productionOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductionOrder $productionOrder)
    {
        $order = ProductionOrder::findOrFail($request->id);
        $order->item_id = $request->item_id;
        $order->quantity = $request->quantity;
        $order->created_by_user_id = $request->created_by_user_id;
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionOrder  $productionOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionOrder $productionOrder)
    {
        $order = ProductionOrder::destroy($request->id);
        return $order;
    }
}
