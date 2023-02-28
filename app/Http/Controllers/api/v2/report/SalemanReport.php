<?php

namespace App\Http\Controllers\api\v2\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Support\Carbon;

class SalemanReport extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $daily_sales = Quotation::select(
            \DB::raw('sum(total) as y'),
            \DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as x")
        )
        ->where('status', 'vendido')
        ->where('user_id', $request->user_id)
        ->whereBetween('created_at', [Carbon::parse($request->date_from), Carbon::parse($request->date_to)])
        ->groupBy('x')->orderBy('x', 'ASC')->get();

        $daily_collections = Collection::select(
            \DB::raw('sum(amount) as y'),
            \DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as x")
        )
        ->where('user_id', $request->user_id)
        ->whereBetween('date', [Carbon::parse($request->date_from), Carbon::parse($request->date_to)])
        ->groupBy('x')->orderBy('x', 'ASC')
        ->get();

        $pending_accounts = Quotation::
        select(
            \DB::raw('sum(total) as y'),
            \DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as x")
        )
        ->doesntHave('collectionDetails')
        ->where('status', 'vendido')
        ->where('user_id', $request->user_id)
        ->whereBetween('created_at', [Carbon::parse($request->date_from), Carbon::parse($request->date_to)])
        ->groupBy('x')->orderBy('x', 'ASC')
        ->get();


        return response(
            [
                "daily_sales_total" => $daily_sales,
                "daily_collections_total" => $daily_collections,
                "collection_pending_accounts_total" => $pending_accounts
            ]
        );
    }
}