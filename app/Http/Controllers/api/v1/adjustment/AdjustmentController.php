<?php

namespace App\Http\Controllers\api\v1\adjustment;

use App\Models\Adjustment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(strpos(json_encode(Auth::user()->permissions), "viewAdjustments")){
            $adjustment = Adjustment::orderBy('updated_at', 'DESC')->get();
        }else{
            $adjustment = Adjustment::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $adjustment;
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
        $adjustment = new Adjustment();

        $adjustment->item_id = $request->item_id;
        $adjustment->date = $request->date;
        $adjustment->amount = $request->amount;
        $adjustment->note = $request->note;
        $adjustment->created_by_user_id = $request->created_by_user_id;
    
        $adjustment->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function show(Adjustment $adjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjustment $adjustment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjustment $adjustment)
    {
        $adjustment = Adjustment::findOrFail($request->id);
        
        $adjustment->item_id = $request->item_id;
        $adjustment->date = $request->date;
        $adjustment->amount = $request->amount;
        $adjustment->note = $request->note;
        $adjustment->created_by_user_id = $request->created_by_user_id;

        $adjustment->save();
        return $adjustment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $adjustment = Adjustment::destroy($request->id);
        return $adjustment;  
    }
}
