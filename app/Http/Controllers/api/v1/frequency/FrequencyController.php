<?php

namespace App\Http\Controllers\api\v1\frequency;

use App\Models\Frequency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrequencyController extends Controller
{
    public function index()
    {
        return Frequency::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $frequency = new Frequency();
        $frequency->frequency = $request->frequency;       
        $frequency->save();
    }
    public function update(Request $request, Frequency $frequency)
    {
        $frequency = Frequency::findOrFail($request->id);
        $frequency->frequency = $request->frequency;
        $frequency->save();
        return $frequency;
    }
    public function destroy(Request $request)
    {
        $frequency = Frequency::destroy($request->id);
        return $frequency;
    }
}
