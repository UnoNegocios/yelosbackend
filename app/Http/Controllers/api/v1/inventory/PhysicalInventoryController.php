<?php

namespace App\Http\Controllers;

use App\Models\PhysicalInventory;
use Illuminate\Http\Request;

class PhysicalInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewPhysicalInventory")){
            $inventory = PhysicalInventory::orderBy('updated_at', 'DESC')->get();
        }else{
            $inventory = PhysicalInventory::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $inventory;
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
        $inventory = new PhysicalInventory();
        $inventory->inventory = $request->inventory;
        $inventory->authorization = $request->authorization;
        $inventory->created_by_user_id = $request->created_by_user_id;
        $inventory->updated_by_user_id = $request->updated_by_user_id;
        $inventory->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhysicalInventory  $physicalInventory
     * @return \Illuminate\Http\Response
     */
    public function show(PhysicalInventory $physicalInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhysicalInventory  $physicalInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(PhysicalInventory $physicalInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhysicalInventory  $physicalInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhysicalInventory $physicalInventory)
    {
        $inventory = PhysicalInventory::findOrFail($request->id);
        $inventory->inventory = $request->inventory;
        $inventory->authorization = $request->authorization;
        $inventory->created_by_user_id = $request->created_by_user_id;
        $inventory->updated_by_user_id = $request->updated_by_user_id;
        $inventory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhysicalInventory  $physicalInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhysicalInventory $physicalInventory)
    {
        $inventory = PhysicalInventory::destroy($request->id);
        return $inventory;
    }
}
