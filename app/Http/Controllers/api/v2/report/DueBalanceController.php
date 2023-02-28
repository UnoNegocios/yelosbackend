<?php

namespace App\Http\Controllers\api\v2\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Spatie\QueryBuilder\QueryBuilder;
use App\Actions\Sales\SaleAdditionalValues;
use Spatie\QueryBuilder\AllowedFilter;

class DueBalanceController extends Controller
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
            AllowedFilter::exact('company_id'),
            AllowedFilter::exact('status')->default('vendido'),
            //AllowedFilter::exact('payment_method_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('company.user_id'),
            AllowedFilter::exact('type'),
            AllowedFilter::exact('bar'),
            AllowedFilter::exact('company.price_list_id')
        ])
        ->get();

        $sum_total = SaleAdditionalValues::getSumTotal($sales);
        //$sum_payments = SaleAdditionalValues::getSumPayments($sales);
        $sum_due_balance = $sum_total - SaleAdditionalValues::getSumPayments($sales);
        $sum_past_due_balance = SaleAdditionalValues::getSumPastDueBalance($sales);
        
        $pendiente_de_pago = SaleAdditionalValues::getPendienteDePago($sales);
        $en_credito = SaleAdditionalValues::getEnCredito($sales);
        $por_cobrar = $sum_total - $sum_past_due_balance - $pendiente_de_pago - $en_credito;

        $sales_length = $sales->count();

        return response()->json([

            //'sum_payments' => $sum_payments,
            //'avg_payments' => $sum_payments/$sales_length,
            'sum_due_balance' => $sum_due_balance,
            'avg_due_balance' => $sum_due_balance/$sales_length,

            'sum_past_due_balance' => $sum_past_due_balance,
            'avg_past_due_balance' => 0,

            'sum_pendientes' => $pendiente_de_pago,
            //'avg_pendientes' => $pendiente_de_pago/$sales_length,

            'sum_credito' => $en_credito,
            //'avg_credito' => $en_credito/$sales_length,

            'sum_cobrar' => $por_cobrar,
            //'avg_cobrar' => $por_cobrar/$sales_length,


        ]);


        
    }
}
