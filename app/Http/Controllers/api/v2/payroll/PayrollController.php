<?php

namespace App\Http\Controllers\api\v2\payroll;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Http\Controllers\Controller;
use App\Http\Resources\payroll\PayrollResource;
use App\Http\Requests\payroll\StorePayrollRequest;
use App\Http\Requests\payroll\UpdatePayrollRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\PayrollFilter; 

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PayrollFilter::execute($request);
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
    public function store(StorePayrollRequest $request)
    {
        $validated = $request->validated();
        
        $payroll = Payroll::create(
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
    public function show(Payroll $payroll)
    {
        return new PayrollResource($payroll);
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
    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        $validated = $request->validated();
        $payroll->update($validated);
        return $payroll;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return response(null, 204);
    }
}
