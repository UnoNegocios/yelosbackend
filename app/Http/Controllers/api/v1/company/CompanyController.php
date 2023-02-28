<?php

namespace App\Http\Controllers\api\v1\company;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewCompanies")){
            $company = Company::orderBy('updated_at', 'DESC')->get();
        }else{
            $company = Company::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $company;
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
        $company = new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->rfc = $request->rfc;
        $company->razon_social = $request->razon_social;
        $company->special_note = $request->special_note;
        $company->phase_id = $request->phase_id;
        $company->origin_id = $request->origin_id;
        $company->user_id = $request->user_id;
        $company->status_id = $request->status_id;
        $company->delivery_address = $request->delivery_address;
        $company->number = $request->number;
        $company->credit_days = $request->credit_days;
        $company->credit_limit = $request->credit_limit;
        $company->consumptions = $request->consumptions;
        $company->opportunity_area = $request->opportunity_area;
        $company->payment_conditions = $request->payment_conditions;
        $company->bank_account_number = $request->bank_account_number;
        $company->delivery_time = $request->delivery_time;
        $company->cfdi_id = $request->cfdi_id;
        $company->type_id = $request->type_id;
        $company->zone_id = $request->zone_id;
        $company->contact_mode_id = $request->contact_mode_id;
        $company->special_conditions = $request->special_conditions;
        $company->payment_method_id = $request->payment_method_id;
        $company->frequency_id = $request->frequency_id;
        $company->price_list_id = $request->price_list_id;
        $company->created_by_user_id = $request->created_by_user_id;
        $company->address_references = $request->address_references;
        $company->save();
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::findOrFail($request->id);
        return $company;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company = Company::findOrFail($request->id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->rfc = $request->rfc;
        $company->razon_social = $request->razon_social;
        $company->special_note = $request->special_note;
        $company->phase_id = $request->phase_id;
        $company->origin_id = $request->origin_id;
        $company->user_id = $request->user_id;
        $company->status_id = $request->status_id;
        $company->delivery_address = $request->delivery_address;
        $company->number = $request->number;
        $company->credit_days = $request->credit_days;
        $company->credit_limit = $request->credit_limit;
        $company->consumptions = $request->consumptions;
        $company->opportunity_area = $request->opportunity_area;
        $company->payment_conditions = $request->payment_conditions;
        $company->bank_account_number = $request->bank_account_number;
        $company->delivery_time = $request->delivery_time;
        $company->cfdi_id = $request->cfdi_id;
        $company->type_id = $request->type_id;
        $company->zone_id = $request->zone_id;
        $company->contact_mode_id = $request->contact_mode_id;
        $company->special_conditions = $request->special_conditions;
        $company->payment_method_id = $request->payment_method_id;
        $company->frequency_id = $request->frequency_id;
        $company->price_list_id = $request->price_list_id;
        $company->created_by_user_id = $request->created_by_user_id;
        $company->address_references = $request->address_references;
        $company->save();
        return $company;//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Company::destroy($request->id);
        return $company;
    }
}
