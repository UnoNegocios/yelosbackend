<?php

namespace App\Http\Controllers\api\v2\shopping;

use Illuminate\Http\Request;
use App\Models\Shopping;
use App\Http\Controllers\Controller;
use App\Http\Resources\shopping\ShoppingResource;
use App\Http\Requests\shopping\StoreShoppingRequest;
use App\Http\Requests\shopping\UpdateShoppingRequest;
use Illuminate\Support\Facades\Hash;
use App\Actions\Shoppings\CreateNewShopping;
use App\Http\Filters\shopping\ShoppingFilter;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ShoppingFilter::execute($request);
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
        $new = new CreateNewShopping();
        $new->excecute($request);
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping)
    {
        return new ShoppingResource($shopping);
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
    public function update(UpdateShoppingRequest $request, Shopping $shopping)
    {
        $validated = $request->validated();
        $shopping->update($validated);
        return $shopping;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping)
    {
        $shopping->delete();
        return response(null, 204);
    }

    public function filter(Request $request)
    {
        return Shopping::filter($request->all())->get();
    }
}
