<?php

namespace App\Http\Controllers\api\v1\rejection;

use App\Models\Rejection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RejectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rejection::orderBy('updated_at', 'DESC')->get();
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
        $rejectionReason = new Rejection();
        $rejectionReason->name = $request->name;       
        $rejectionReason->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return \Illuminate\Http\Response
     */
    public function show(Rejection $rejection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return \Illuminate\Http\Response
     */
    public function edit(Rejection $rejection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rejection  $rejection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rejection $rejection)
    {
        $rejectionReason = Rejection::findOrFail($request->id);
        $rejectionReason->name = $request->name; 
        $rejectionReason->save();
        return $rejectionReason;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rejectionReason = Rejection::destroy($request->id);
        return $rejectionReason;
    }
}
