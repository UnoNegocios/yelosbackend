<?php

namespace App\Http\Controllers\api\v2\report;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Quotation;
use App\Http\Resources\sale\TotalIndicatorsResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\CollectionDetail;
use App\Actions\Sales\SaleAdditionalValues;
use App\Http\Controllers\Controller;

class ReportTotalIndicators extends Controller
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
            AllowedFilter::exact('production_dispatched'),
            AllowedFilter::exact('remission'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between')
        ])
        ->get();
        //->paginate($request->itemsPerPage)->appends(request()->query());

       // $sales_global = $sales->get();
       // $filtered_sales = $sales->paginate($request->itemsPerPage)->appends(request()->query());

        $sum_total = SaleAdditionalValues::getSumTotal($sales);
        $sum_subtotal = SaleAdditionalValues::getSumSubtotal($sales);
        $sum_iva = SaleAdditionalValues::getSumIva($sales);
        $sales_length = $sales->count();
       
        return response()->json([
            'sum_total' => $sum_total,
            'avg_total' => $sum_total/$sales_length,
            'sum_iva' => $sum_iva,
            'avg_iva' => $sum_iva/$sales_length,
            'sum_subtotal' => $sum_subtotal,
            'avg_subtotal' => $sum_subtotal/$sales_length


        ]);
       /* ->additional([
            'values' => [
            'sum_total' => (string)$sales->where('status', 'vendido')->sum('total'),
            'avg_total' => (string)$sales->where('status', 'vendido')->avg('total'),

            'sum_total_cancelled' => (string)$sales->where('status', 'cancelled')->sum('total'),
            'avg_total_cancelled' => (string)$sales->where('status', 'cancelled')->avg('total'),


            'sum_iva' => (string)$sales->where('status', 'vendido')->sum('iva'),
            'avg_iva' => (string)$sales->where('status', 'vendido')->avg('iva'),
            'sum_subtotal' => (string)$sales->where('status', 'vendido')->sum('subtotal'),
            'avg_subtotal' => (string)$sales->where('status', 'vendido')->avg('subtotal'),
            
            'sum_payments' => SaleAdditionalValues::getSumPayments($sales_global),
            'avg_payments' => SaleAdditionalValues::getSumPayments($sales_global)/$sales_global->count(),
            'sum_due_balance' => (string)$sales->sum('total') - SaleAdditionalValues::getSumPayments($sales_global),
            'avg_due_balance' => ((string)$sales->sum('total') - SaleAdditionalValues::getSumPayments($sales_global))/$sales_global->count(),
            'sum_past_due_balance' => SaleAdditionalValues::getSumPastDueBalance($sales_global),
            'avg_past_due_balance' => SaleAdditionalValues::getSumPastDueBalance($sales_global)/$sales_global->count(),
        ]]);;*/
    }
}
