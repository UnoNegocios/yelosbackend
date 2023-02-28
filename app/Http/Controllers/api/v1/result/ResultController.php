<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Result::orderBy('updated_at', 'DESC')->get();
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
        $result = new Result();
        $result->date = $request->date;
        $result->year = $request->year;
        $result->month = $request->month;
        $result->day = $request->day;
        $result->accounts_receivable = $request->accounts_receivable;
        $result->debts_to_pay = $request->debts_to_pay;
        $result->inventory = $request->inventory;
        $result->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        $result = Result::findOrFail($request->id);
        $result->date = $request->date;
        $result->year = $request->year;
        $result->month = $request->month;
        $result->day = $request->day;
        $result->accounts_receivable = $request->accounts_receivable;
        $result->debts_to_pay = $request->debts_to_pay;
        $result->inventory = $request->inventory;
        $result->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result = Result::destroy($request->id);
        return $result;
    }
}
