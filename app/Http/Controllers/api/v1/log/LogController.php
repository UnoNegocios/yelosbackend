<?php

namespace App\Http\Controllers\api\v1\log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){
        $activities = Log::orderBy('created_at', 'DESC')//->where('date', '>=', '2022-01-01')
        ->get();
        return $activities;
    }
}