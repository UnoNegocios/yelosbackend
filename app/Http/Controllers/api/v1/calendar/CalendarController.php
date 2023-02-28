<?php

namespace App\Http\Controllers\api\v1\calendar;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if(strpos(json_encode(Auth::user()->permissions), "viewActivities")){
                $calendar = Calendar::orderBy('date', 'DESC')->where('date', '>=', '2022-03-01')->get();
            }else{
                $calendar = Calendar::where('user_id', Auth::user()->id)->orderBy('date', 'DESC')->where('date', '>=', '2022-03-01')->get();
            }
            return $calendar;
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
        $calendar = new Calendar();
        $calendar->company_id = $request->company_id; 
        $calendar->contact_id = $request->contact_id;
        $calendar->activity_id = $request->activity_id;
        $calendar->date = $request->date;
        $calendar->only_date = $request->only_date;
        $calendar->only_time = $request->only_time;
        $calendar->description = $request->description;
        $calendar->completed = $request->completed;
        $calendar->user_id = $request->user_id;
        $calendar->lead_id = $request->lead_id;
        $calendar->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        $calendar = Calendar::findOrFail($request->id);
        $calendar->company_id = $request->company_id; 
        $calendar->contact_id = $request->contact_id;
        $calendar->activity_id = $request->activity_id;
        $calendar->date = $request->date;
        $calendar->only_date = $request->only_date;
        $calendar->only_time = $request->only_time;
        $calendar->description = $request->description;
        $calendar->completed = $request->completed;
        $calendar->user_id = $request->user_id;
        $calendar->save();
        return $calendar;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $calendar = Calendar::destroy($request->id);
        return $calendar;  
    }

    public function bulkStore(Request $request)
    {
        $user = User::findOrFail($request[0]->user_id);
        $user->calendars()->saveMany(json_decode($request));
    }
}
