<?php

namespace App\Http\Controllers\api\v2\item;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Http\Resources\item\ItemMinResource;
use App\Http\Requests\item\StoreItemRequest;
use App\Http\Requests\item\UpdateItemRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\item\ItemPosFilter;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemMinResource::collection(Item::all());
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
    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();
        
        $item = Item::create(
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
    public function show(Item $item)
    {
        return new ItemMinResource($item);
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
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();
        $item->update($validated);
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response(null, 204);
    }

    public function pos(Request $request){
        return ItemPosFilter::execute($request);
    }

    public function posSync(Request $request){
       /// $items = $request->all();

        //foreach ($items as $key => $value) {
            $item = Item::updateOrCreate(
                ['sku' =>  62453],
                ['macro' => 6453]
            );
       // }
    }
}
