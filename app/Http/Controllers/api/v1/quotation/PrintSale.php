<?php

namespace App\Http\Controllers\api\v1\quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;

class PrintSale extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sale = Quotation::findOrFail($request['id'])->update([
            'printed' => 1,
            'last_updated_by_user_id' => Auth::user()->id
        ]);
        return response(null, 202);
    }
}
