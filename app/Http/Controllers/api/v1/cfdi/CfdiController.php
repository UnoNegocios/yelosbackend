<?php

namespace App\Http\Controllers\api\v1\cfdi;

use App\Models\Cfdi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CfdiController extends Controller
{
    public function index()
    {
        return Cfdi::all();
    }
    public function store(Request $request)
    {
        $cfdi = new Cfdi();
        $cfdi->cfdi = $request->cfdi;       
        $cfdi->save();
    }
    public function update(Request $request, Cfdi $cfdi)
    {
        $cfdi = Cfdi::findOrFail($request->id);
        $cfdi->cfdi = $request->cfdi;
        $cfdi->save();
        return $cfdi;
    }
    public function destroy(Request $request)
    {
        $cfdi = Cfdi::destroy($request->id);
        return $cfdi;
    }
}
