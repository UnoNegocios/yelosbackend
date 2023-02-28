<?php

namespace App\Http\Controllers\api\v1\zone;

use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZoneController extends Controller
{
    public function index()
    {
        return Zone::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $zone = new Zone();
        $zone->zone = $request->zone;       
        $zone->save();
    }
    public function update(Request $request, Zone $zone)
    {
        $zone = Zone::findOrFail($request->id);
        $zone->zone = $request->zone;
        $zone->save();
        return $zone;
    }
    public function destroy(Request $request)
    {
        $zone = Zone::destroy($request->id);
        return $zone;
    }
}
