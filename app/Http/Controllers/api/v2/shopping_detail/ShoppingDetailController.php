<?php

namespace App\Http\Controllers\api\v2\shopping_detail;

use Illuminate\Http\Request;
use App\Models\ShoppingDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\shopping_detail\ShoppingDetailResource;
//use App\Http\Requests\shopping_detail\StoreShoppingDetailRequest;
//use App\Http\Requests\shopping_detail\UpdateShoppingDetailRequest;
use Illuminate\Support\Facades\Hash;
use App\Actions\ShoppingDetails\CreateNewShoppingDetail;

class ShoppingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ShoppingDetail::all();
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
        {
            $data = $request['products'];
            foreach($data as $key => $value){
                $shopping_detail = new ShoppingDetail();
                $shopping_detail->shopping_id = $request->id;
                $shopping_detail->item_id = $value['item_id'];
                $shopping_detail->quantity = $value['quantity'];
                $shopping_detail->unit_cost = $value['unit_cost'];
                $shopping_detail->created_by_user_id = $request->created_by_user_id;
                $shopping_detail->last_updated_by_user_id = $request->last_updated_by_user_id;
                $shopping_detail->save();
            }
        return response(null, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingDetail $shopping_detail)
    {
        return new ShoppingDetailResource($shopping_detail);
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
    public function update(UpdateShoppingDetailRequest $request, ShoppingDetail $shopping_detail)
    {
        $validated = $request->validated();
        $shopping_detail->update($validated);
        return $shopping_detail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingDetail $shopping_detail)
    {
        $shopping_detail->delete();
        return response(null, 204);
    }

    public function filter(Request $request)
    {
        return ShoppingDetail::filter($request->all())->get();
    }
}
