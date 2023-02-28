<?php

namespace App\Http\Controllers\api\v1\payment_method;

use App\Models\Payment_method;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MethodController extends Controller
{
    public function index()
    {
        return Payment_method::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $method = new Payment_method();
        $method->method = $request->method;       
        $method->save();
    }
    public function update(Request $request, Payment_method $method)
    {
        $method = Payment_method::findOrFail($request->id);
        $method->method = $request->method;
        $method->save();
        return $method;
    }
    public function destroy(Request $request)
    {
        $method = Payment_method::destroy($request->id);
        return $method;
    }
}
