<?php

namespace App\Http\Controllers\api\v1\type;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function index()
    {
        return Type::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $type = new Type();
        $type->type = $request->type;       
        $type->save();
    }
    public function update(Request $request, Type $type)
    {
        $type = Type::findOrFail($request->id);
        $type->type = $request->type;
        $type->save();
        return $type;
    }
    public function destroy(Request $request)
    {
        $type = Type::destroy($request->id);
        return $type;
    }
}
