<?php

namespace App\Http\Controllers\api\v2\sale;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\sale\TotalIndicatorsResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\CollectionDetail;
use App\Actions\Sales\SaleAdditionalValues;
use App\Http\Controllers\Controller;

class DueBalance extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sales = QueryBuilder::for(Quotation::class)
        ->where('date', '>=', '2022-01-01')
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('status')->default('vendido'),
            AllowedFilter::exact('company_id'),
            AllowedFilter::exact('contact_id'),
            AllowedFilter::exact('company.user_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('pdf'),
            'note',
            //items
           
            AllowedFilter::exact('rejection_id'),
            'rejection_comment',
            AllowedFilter::exact('created_at'),
            AllowedFilter::exact('updated_at'),
            AllowedFilter::exact('bar'),
            AllowedFilter::exact('date'),
            AllowedFilter::exact('type'),
            ///total
            'invoice',
            AllowedFilter::exact('printed'),
            AllowedFilter::exact('due_date'),
            AllowedFilter::exact('invoice_date'),
            AllowedFilter::exact('company.user_id'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('production_dispatched')->default(1),
            AllowedFilter::exact('remission'),
            AllowedFilter::exact('payment_status'),
            //AllowedFilter::scope('payment_status'),
           /* AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between')*/
        ])
        ->get();

        $sum_past_due_balance = $sales->where('payment_status', 'Vencida')->sum('total');
        $sum_due_balance = $sales->whereIn('payment_status',['Vencida', 'En Crédito', 'En Proceso'])->sum('total');
        
        $past_due_balance_length = $sales->where('payment_status', 'Vencida')->count();
        $due_balance_length = $sales->whereIn('payment_status',['Vencida', 'En Crédito', 'En Proceso'])->count();

        return response()->json([

            'sum_past_due_balance' => $sum_past_due_balance,
            'sum_due_balance' => $sum_due_balance,
            'avg_past_due_balance' => $sum_past_due_balance / $past_due_balance_length,
            'avg_due_balance' => $sum_due_balance / $due_balance_length,

        ]);
    }
}