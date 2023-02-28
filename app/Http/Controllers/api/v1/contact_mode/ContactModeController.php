<?php

namespace App\Http\Controllers\api\v1\contact_mode;

use App\Models\ContactMode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactModeController extends Controller
{
    public function index()
    {
        return ContactMode::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $mode = new ContactMode();
        $mode->mode = $request->mode;       
        $mode->save();
    }
    public function update(Request $request, ContactMode $mode)
    {
        $mode = ContactMode::findOrFail($request->id);
        $mode->mode = $request->mode;
        $mode->save();
        return $mode;
    }
    public function destroy(Request $request)
    {
        $mode = ContactMode::destroy($request->id);
        return $mode;
    }
}
