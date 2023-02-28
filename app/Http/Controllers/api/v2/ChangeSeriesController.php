<?php

namespace App\Http\Controllers\api\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;

class ChangeSeriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            $perro = Collection::findOrFail($value['id'])
            ->update([
               'serie' => $value['serie']
            ]);
           };
    }
}
