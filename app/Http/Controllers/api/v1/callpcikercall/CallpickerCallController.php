<?php

namespace App\Http\Controllers\api\v1\callpcikercall;

use App\Models\CallpickerCall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CallpickerCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $call = CallpickerCall::where('date', '>', (new \Carbon\Carbon)->submonths(2) )->orderBy('date', 'DESC')->get();
       if(strpos(json_encode(Auth::user()->permissions), "viewCalls")){
        $callpickercall = CallpickerCall::orderBy('updated_at', 'DESC')->where('created_at', '>=', '2022-06-01')->get();
    }else{
        $callpickercall = CallpickerCall::where('callpicker_number', Auth::user()->phone)->orderBy('updated_at', 'DESC')->where('created_at', '>=', '2022-06-01')->get();
    }
    return $callpickercall;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeCall()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CallpickerCall  $callpickerCall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallpickerCall $callpickercall)
    {
        $callpickercall = CallpickerCall::findOrFail($request->id);
        $callpickercall->note = $request->note;
        $callpickercall->save();
        return $callpickercall;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CallpickerCall  $callpickerCall
     * @return \Illuminate\Http\Response
     */

}
