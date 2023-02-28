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
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;


class TotalIndicators extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sales = QueryBuilder::for(Quotation::class)->with('collectionDetails')
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
            AllowedFilter::exact('remission'),
            AllowedFilter::exact('payment_status'),
            //AllowedFilter::scope('payment_status'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between'),
            AllowedFilter::exact('production_dispatched')->default(1),
        ])
        ->get();

        $sales2 = QueryBuilder::for(Quotation::class)->with('collectionDetails')
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
            AllowedFilter::callback('created_at', function (Builder $query, $value){$query;}),
            AllowedFilter::callback('updated_at', function (Builder $query, $value){$query;}),
            AllowedFilter::exact('bar'),
            AllowedFilter::callback('date', function (Builder $query, $value){$query;}),
            AllowedFilter::exact('type'),
            ///total
            'invoice',
            AllowedFilter::exact('printed'),
            AllowedFilter::callback('due_date', function (Builder $query, $value){$query;}),
            AllowedFilter::exact('invoice_date'),
            AllowedFilter::exact('company.user_id'),
            AllowedFilter::exact('created_by_user_id'),
            AllowedFilter::exact('last_updated_by_user_id'),
            AllowedFilter::exact('remission'),
            AllowedFilter::exact('payment_status'),
            //AllowedFilter::scope('payment_status'),
            AllowedFilter::callback('date_between', function (Builder $query, $value){$query;}),
            AllowedFilter::callback('created_between', function (Builder $query, $value){$query;}),
            AllowedFilter::callback('updated_between', function (Builder $query, $value){$query;}),
            AllowedFilter::exact('production_dispatched')->default(1),
        ])
        ->get();





        $sum_total = SaleAdditionalValues::getSumTotal($sales);
        $sum_subtotal = SaleAdditionalValues::getSumSubtotal($sales);
        $sum_iva = SaleAdditionalValues::getSumIva($sales);
        $sum_utilities = SaleAdditionalValues::getSumUtilities($sales);
        $sum_weights = SaleAdditionalValues::getSumWeight($sales);
        $collections = collect(Arr::flatten($sales->pluck('collectionDetails')));
        $collections_vencidas = collect(Arr::flatten($sales2->where('payment_status', 'Vencida')->pluck('collectionDetails')));

        $collections_due = collect(Arr::flatten($sales2->whereIn('payment_status', ['Vencida', 'En Crédito', 'En Proceso'])->pluck('collectionDetails')));
        $collections_credit = collect(Arr::flatten($sales->where('payment_status', 'En Crédito')->pluck('collectionDetails')));

        
        $sales_length = $sales->count();
        $past_due_balance_length = $sales2->where('payment_status', 'Vencida')->count();
        $payments_length = $sales->where('payment_status', 'Cobrada')->count();
        $due_balance_length = $sales2->whereIn('payment_status',['Vencida', 'En Crédito', 'En Proceso'])->count();
        $credit_length = $sales->where('payment_status', 'En Crédito')->count();

        $sum_past_due_balance = $sales2->where('payment_status', 'Vencida')->sum('total') - $collections_vencidas->sum('amount');
        $sum_payments = $collections->sum('amount');
        $sum_due_balance = $sales2->whereIn('payment_status',['Vencida', 'En Crédito', 'En Proceso'])->sum('total') - $collections_due->sum('amount');
        $sum_credit = $sales->where('payment_status', 'En Crédito')->sum('total') - $collections_credit->sum('amount');
       
        return response()->json([
            
            'sum_total' => $sum_total,
            'avg_total' => $sum_total/$sales_length,

            'sum_iva' => $sum_iva,
            'avg_iva' => $sum_iva/$sales_length,

            'sum_subtotal' => $sum_subtotal,
            'avg_subtotal' => $sum_subtotal/$sales_length,

            'sum_past_due_balance' => $sum_past_due_balance,
            'avg_past_due_balance' => $sum_past_due_balance / $past_due_balance_length,

            'sum_payments' => $sum_payments,
            'avg_payments' => $sum_payments / $payments_length,

            'sum_due_balance' => $sum_due_balance,
            'avg_due_balance' => $sum_due_balance / $due_balance_length,

            'sum_credit' => $sum_credit,
            'avg_credit' => $sum_credit/$credit_length,

            'sum_utilities' => $sum_utilities,
            'avg_utilities' => $sum_utilities/$sales_length,

            'sum_weights' => $sum_weights,
            'avg_weights' => $sum_weights/$sales_length,

        ]);

        //return response([$sales->sum('total'), $sales2->sum('total')]);

    }
}