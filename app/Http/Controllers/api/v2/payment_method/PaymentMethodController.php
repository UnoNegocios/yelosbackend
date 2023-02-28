<?php

namespace App\Http\Controllers\api\v2\payment_method;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Resources\payment_method\PaymentMethodResource;
use App\Http\Requests\payment_method\StorePaymentMethodRequest;
use App\Http\Requests\payment_method\UpdatePaymentMethodRequest;
use Illuminate\Support\Facades\Hash;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PaymentMethodResource::collection(PaymentMethod::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $validated = $request->validated();
        
        $payment_method = PaymentMethod::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $payment_method)
    {
        return new PaymentMethodResource($payment_method);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $payment_method)
    {
        $validated = $request->validated();
        $payment_method->update($validated);
        return $payment_method;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $payment_method)
    {
        $payment_method->delete();
        return response(null, 204);
    }
}
