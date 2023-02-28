<?php

Route::get('/pez', function (Request $request) {

    $sales = Quotation::where('status', 'vendido')
    ->where('date', '>=', '2022-01-01')
    ->where('payment_status', 'Vencida')
    ->where('production_dispatched', 1)
    ->get();

    $quotationsArray = [];

    foreach($sales as $sale) {

        $collections = $sale->collectionDetails->sum('amount');
        $expiration_days = (double)date_diff(Carbon::parse($sale->date)->addDays($sale->company->credit_days), now())->format('%R%a');

        $modifiedData["company"] = $sale->company;
        $modifiedData["expiration_days"] = $expiration_days;
        $modifiedData["total"] = $sale->total - $collections;
        $modifiedData["salesman"] = $sale->company->user;

        $quotationsArray[] = $modifiedData;

    }

    return response()->json($quotationsArray);

});