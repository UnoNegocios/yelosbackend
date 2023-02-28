<?php

namespace App\Http\Controllers\api\v1\shopping;

use App\Models\Shopping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewShopping")){
            $shopping = Shopping::orderBy('date', 'DESC')->get();
        }else{
            $shopping = Shopping::where('created_by_user_id', Auth::user()->id)->orderBy('date', 'DESC')->get();
        }
        return $shopping;
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
        $shopping = new Shopping();
        $shopping->date = $request->date;
        $shopping->serie = $request->serie;
        $shopping->provider_id = $request->provider_id;
       // $shopping->category_id = $request->category_id;
        $shopping->invoice = $request->invoice;
        $shopping->due_date = $request->due_date;
        $shopping->notes = $request->notes;
        $shopping->pdf = $request->pdf;
        $shopping->xml = $request->xml;
        $shopping->created_by_user_id = $request->created_by_user_id;
        $shopping->last_updated_by_user_id = $request->last_updated_by_user_id;
        $shopping->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopping $shopping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping)
    {
        $shopping = Shopping::findOrFail($request->id);
        $shopping->date = $request->date;
        $shopping->serie = $request->serie;
        $shopping->provider_id = $request->provider_id;
        $shopping->invoice = $request->invoice;
        $shopping->due_date = $request->due_date;
        $shopping->notes = $request->notes;
        $shopping->pdf = $request->pdf;
        $shopping->xml = $request->xml;
        $shopping->created_by_user_id = $request->created_by_user_id;
        $shopping->last_updated_by_user_id = $request->last_updated_by_user_id;
        $shopping->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $shopping = Shopping::destroy($request->id);
        return $shopping;
    }
}
