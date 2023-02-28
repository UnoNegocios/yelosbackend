<?php

namespace App\Http\Controllers\api\v1\provider_payment;

use App\Models\ProviderPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProviderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewProviderPayments")){
            $provider_payment = ProviderPayment::orderBy('updated_at', 'DESC')->get();
        }else{
            $provider_payment = ProviderPayment::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $provider_payment;
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
    public function store(Request $request)
    {
        $provider_payment = new ProviderPayment();
        $provider_payment->shoppingsID = $request->shoppingsID;
        $provider_payment->date = $request->date;
        $provider_payment->amount = $request->amount;
        $provider_payment->payment_method = $request->payment_method;
        $provider_payment->note = $request->note;
        $provider_payment->provider_id = $request->provider_id;
        $provider_payment->created_by_user_id = $request->created_by_user_id;
        $provider_payment->last_updated_by_user_id = $request->last_updated_by_user_id;
        $provider_payment->save();   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProviderPayment  $providerPayment
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderPayment $providerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProviderPayment  $providerPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderPayment $providerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProviderPayment  $providerPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderPayment $providerPayment)
    {
        $provider_payment = ProviderPayment::findOrFail($request->id);
        $provider_payment->shoppingsID = $request->shoppingsID;
        $provider_payment->date = $request->date;
        $provider_payment->amount = $request->amount;
        $provider_payment->payment_method = $request->payment_method;
        $provider_payment->note = $request->note;
        $provider_payment->provider_id = $request->provider_id;
        $provider_payment->created_by_user_id = $request->created_by_user_id;
        $provider_payment->last_updated_by_user_id = $request->last_updated_by_user_id;
        $provider_payment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProviderPayment  $providerPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        {
            $provider_payment = ProviderPayment::destroy($request->id);
            return $provider_payment;  
        }
    }
}
