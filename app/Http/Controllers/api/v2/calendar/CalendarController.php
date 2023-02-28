<?php

namespace App\Http\Controllers\api\v2\calendar;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Http\Controllers\Controller;
use App\Http\Resources\calendar\CalendarResource;
use App\Http\Requests\calendar\StoreCalendarRequest;
use App\Http\Requests\calendar\UpdateCalendarRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\calendar\CalendarFilter;
use App\Http\Filters\calendar\CalendarList;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return CalendarFilter::excecute($request);
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
    public function store(StoreCalendarRequest $request)
    {
        $validated = $request->validated();
        
        $calendar = Calendar::create(
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
    public function show(Calendar $calendar)
    {
        return new CalendarResource($calendar);
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
    public function update(UpdateCalendarRequest $request, Calendar $calendar)
    {
        $validated = $request->validated();
        $calendar->update($validated);
        return $calendar;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response(null, 204);
    }

    public function calendarList(Request $request)
    {
        return CalendarList::excecute($request);
    }

}
