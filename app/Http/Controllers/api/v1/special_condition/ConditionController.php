<?php

namespace App\Http\Controllers\api\v1\special_condition;

use App\Models\Special_condition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConditionController extends Controller
{
    public function index()
    {
        return Special_condition::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $condition = new Special_condition();
        $condition->condition = $request->condition;       
        $condition->save();
    }
    public function update(Request $request, Special_condition $condition)
    {
        $condition = Special_condition::findOrFail($request->id);
        $condition->condition = $request->condition;
        $condition->save();
        return $condition;
    }
    public function destroy(Request $request)
    {
        $condition = Special_condition::destroy($request->id);
        return $condition;
    }
}
