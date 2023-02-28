<?php

namespace App\Http\Controllers\api\v2\order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Filters\DispatchedOrdersFilter;

class DispatchedOrders extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return DispatchedOrdersFilter::excecute($request);
    }
}
