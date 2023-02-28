<?php

namespace App\Http\Controllers\api\v1\inventory;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inventory::orderBy('updated_at', 'DESC')->get();
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
        $inventory = new Inventory();
        $inventory->item_id = $request->item_id;
        $inventory->type = $request->type;
        $inventory->quantity = $request->quantity;
        $inventory->inventory = $request->inventory;
        $inventory->shopping_id = $request->shopping_id;
        $inventory->production_id = $request->production_id;
        $inventory->sale_id = $request->sale_id;
        $inventory->created_by_user_id = $request->created_by_user_id;

        $inventory->save();

        return $inventory;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $inventory = Inventory::findOrFail($request->id);
        $inventory->item_id = $request->item_id;
        $inventory->type = $request->type;
        $inventory->quantity = $request->quantity;
        $inventory->inventory = $request->inventory;
        $inventory->shopping_id = $request->shopping_id;
        $inventory->production_id = $request->production_id;
        $inventory->sale_id = $request->sale_id;
        $inventory->created_by_user_id = $request->created_by_user_id;
        $inventory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inventory = Inventory::destroy($request->id);
        return $inventory;
    }

    public function bulkCreate(Request $request) {
        $data = $request->all();
     
         foreach ($data as $key => $value) {

             Inventory::create([
               'item_id' => $data[$key]['item_id'],
               'type' => $data[$key]['type'],
               'quantity' => $data[$key]['quantity'],
               'inventory' => $data[$key]['inventory'],
               'created_by_user_id' => $data[$key]['created_by_user_id'],
           ]);

           };

        }

}
