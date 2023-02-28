<?php

namespace App\Http\Controllers\api\v2\payroll;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Payroll;
use App\Http\Resources\payroll\TotalIndicatorsResource;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\PayrollDetail;
use App\Actions\Payrolls\PayrollAdditionalValues;
use App\Http\Controllers\Controller;

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
        $payrolls = QueryBuilder::for(Payroll::class)
        ->allowedFilters([
            'notes',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('user.job_position'),
            AllowedFilter::scope('date_between'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::scope('updated_between'),
        ])
        ->get();

        $payroll = $payrolls;
        $total_payroll = $payrolls;
        
        //->paginate($request->itemsPerPage)->appends(request()->query());

       // $sales_global = $sales->get();
       // $filtered_sales = $sales->paginate($request->itemsPerPage)->appends(request()->query());


       
        return response()->json([[
            'label' => 'Monto',
            'sum' => $payroll->sum('amount'),
            'avg' => $payroll->avg('amount'),
        ],
        [
            'label' => 'IMSS',
            'sum' => $payroll->sum('imss'),
            'avg' => $payroll->avg('imss'),
        ],
        [
            'label' => 'Infonavit',
            'sum' => $payroll->sum('infonavit'),
            'avg' => $payroll->avg('infonavit'),
        ],
        [
            'label' => 'Faltas',
            'sum' => $payroll->sum('absence'),
            'avg' => $payroll->avg('absence'),
        ],
        [
            'label' => 'Prestamos',
            'sum' => $payroll->sum('loan'),
            'avg' => $payroll->avg('loan'),
        ],
        [
            'label' => 'Prima Vacacional',
            'sum' => $payroll->sum('prima_vacacional'),
            'avg' => $payroll->avg('prima_vacacional'),
        ],
        [
            'label' => 'Vacaciones',
            'sum' => $payroll->sum('holidays'),
            'avg' => $payroll->avg('holidays'),
        ],
        [
            'label' => 'Tiempo Extra',
            'sum' => $payroll->sum('extra_time'),
            'avg' => $payroll->avg('extra_time'),
        ],
        [
            'label' => 'Premio Producción',
            'sum' => $payroll->sum('production_award'),
            'avg' => $payroll->avg('production_award'),
        ],
        [
            'label' => 'Premio Puntualidad',
            'sum' => $payroll->sum('punctuality_award'),
            'avg' => $payroll->avg('punctuality_award'),
        ],
        [
            'label' => 'Premio Rendimiento',
            'sum' => $payroll->sum('performance_award'),
            'avg' => $payroll->avg('performance_award'),
        ],
        [
            'label' => 'Neto a Pagar',
            'sum' => ((($total_payroll->sum('amount') + $total_payroll->sum('extra_time') + $total_payroll->sum('prima_vacacional') + $total_payroll->sum('holidays') + $total_payroll->sum('production_award') + $total_payroll->sum('punctuality_award') + $total_payroll->sum('performance_award'))*1) - (($total_payroll->sum('imss') + $total_payroll->sum('infonavit') + $total_payroll->sum('absence') + $total_payroll->sum('loan'))*1)),
            'avg' => ((($total_payroll->sum('amount') + $total_payroll->avg('extra_time') + $total_payroll->avg('prima_vacacional') + $total_payroll->avg('holidays') + $total_payroll->avg('production_award') + $total_payroll->avg('punctuality_award') + $total_payroll->avg('performance_award'))*1) - (($total_payroll->avg('imss') + $total_payroll->avg('infonavit') + $total_payroll->avg('absence') + $total_payroll->avg('loan'))*1)),
        ]      
        ]);
    }
}
