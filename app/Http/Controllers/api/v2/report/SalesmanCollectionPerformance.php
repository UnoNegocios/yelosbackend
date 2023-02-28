<?php

namespace App\Http\Controllers\api\v2\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Collection;
use App\Models\User;
use App\Http\Resources\sale\SalePastDueDaysAverageResource;
use Illuminate\Support\Carbon;

class SalesmanCollectionPerformance extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {

        $users = User::where('job_position', 'vendedor')
        
        ->select(
            \DB::raw('id as id'),
            \DB::raw("name as num_days_past_due")
        )->get();

        foreach($users as $key => $user) {
            $perro = Quotation::where('status', 'vendido')
            ->whereBetween('created_at', [Carbon::parse($request->date_from), Carbon::parse($request->date_to)])
            ->get()
            ->where('salesman', $user->id);

            $users[$key]->num_days_past_due = $perro->avg('num_days_past_due');
        }
        return $users;
        /*return response(
            [
                "daily_sales_total" => $daily_sales,
                "daily_collections_total" => $daily_collections,
                "collection_pending_accounts_total" => $pending_accounts
            ]
        );*/
    }
}