<?php

namespace App\Http\Controllers\api\v1\production;

use App\Models\Production;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewProductions")){
            $production = Production::orderBy('updated_at', 'DESC')->get();
        }else{
            $production = Production::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $production;
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
        $production = new Production();
        $production->date = $request->date;
        $production->created_by_user_id = $request->created_by_user_id;
        $production->updated_by_user_id = $request->updated_by_user_id;
        $production->user_id = $request->user_id;
        $production->status = $request->status;
        $production->start_time = $request->start_time;
        $production->end_time = $request->end_time;    
        $production->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Production $production)
    {
        $production = Production::findOrFail($request->id);
        $production->date = $request->date;
        $production->created_by_user_id = $request->created_by_user_id;
        $production->updated_by_user_id = $request->updated_by_user_id;
        $production->user_id = $request->user_id;
        $production->status = $request->status;
        $production->start_time = $request->start_time;
        $production->end_time = $request->end_time;   
        $production->save();
        return $production;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $production = Production::destroy($request->id);
        return $production;
    }
}
