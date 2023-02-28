<?php

namespace App\Http\Controllers\api\v1\payroll;

use App\Models\Payroll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewPayRolls")){
            $payroll = Payroll::orderBy('updated_at', 'DESC')->get();
        }else{
            $payroll = Payroll::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $payroll;
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
        $payroll = new Payroll();  
        $payroll->date = $request->date;
        $payroll->user_id = $request->user_id;
        $payroll->imss = $request->imss;
        $payroll->infonavit = $request->infonavit;
        $payroll->amount = $request->amount;
        $payroll->extra_time = $request->extra_time;
        $payroll->production_award =  $request->production_award;
        $payroll->punctuality_award = $request->punctuality_award;
        $payroll->performance_award = $request->performance_award;
        $payroll->absence = $request->absence;
        $payroll->notes = $request->notes;
        $payroll->created_by_user_id = $request->created_by_user_id;
        $payroll->last_updated_by_user_id = $request->last_updated_by_user_id;
        $payroll->loan = $request->loan;
        $payroll->holidays = $request->holidays;
        $payroll->prima_vacacional = $request->prima_vacacional;
        $payroll->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        $payroll = Payroll::findOrFail($request->id);
        $payroll->date = $request->date;
        $payroll->user_id = $request->user_id;
        $payroll->imss = $request->imss;
        $payroll->infonavit = $request->infonavit;
        $payroll->amount = $request->amount;
        $payroll->extra_time = $request->extra_time;
        $payroll->production_award =  $request->production_award;
        $payroll->punctuality_award = $request->punctuality_award;
        $payroll->performance_award = $request->performance_award;
        $payroll->absence = $request->absence;
        $payroll->notes = $request->notes;
        $payroll->created_by_user_id = $request->created_by_user_id;
        $payroll->last_updated_by_user_id = $request->last_updated_by_user_id;
        $payroll->loan = $request->loan;
        $payroll->holidays = $request->holidays;
        $payroll->prima_vacacional = $request->prima_vacacional;
        $payroll->save();
        return $payroll;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $payroll = Payroll::destroy($request->id);
        return $payroll;
    }
}
