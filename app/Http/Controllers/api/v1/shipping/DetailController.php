<?php

namespace App\Http\Controllers\api\v1\shipping;

use App\Models\ShippingDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Quotation;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewShippingDetail")){
            $detail = ShippingDetail::orderBy('updated_at', 'DESC')->get();
        }else{
            $detail = ShippingDetail::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $detail;
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
        $detail = new ShippingDetail();
        $detail->sale_id = $request->sale_id;
        $detail->shipping_id = $request->shipping_id;
        $detail->completed = $request->completed;
        $detail->invoice = $request->invoice;
        $detail->pdf = $request->pdf;
        $detail->created_by_user_id = $request->created_by_user_id;
        $detail->last_updated_by_user_id = $request->last_updated_by_user_id;
        $detail->save();

        $invoice = Quotation::findOrFail($detail->sale_id);
        $invoice->invoice = $detail->invoice;
        $invoice->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingDetail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingDetail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingDetail $detail)
    {
        $detail = ShippingDetail::findOrFail($request->id);
        $detail->sale_id = $request->sale_id;
        $detail->shipping_id = $request->shipping_id;
        $detail->completed = $request->completed;
        $detail->invoice = $request->invoice;
        $detail->pdf = $request->pdf;
        $detail->created_by_user_id = $request->created_by_user_id;
        $detail->last_updated_by_user_id = $request->last_updated_by_user_id;
        $detail->save();

        $invoice = Quotation::findOrFail($detail->sale_id);
        $invoice->invoice = $detail->invoice;
        $invoice->save();
        
        return $detail;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $detail = ShippingDetail::destroy($request->id);
        return $detail;
    }

    public function files(Request $request){
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('../public/files'), $fileName);
        return response()->json(['file' => $fileName]);
    }  

    public function barSalesBulkUpdate(Request $request) {
        $data = $request->all();

        foreach ($data as $key => $value) {
      
         $perro = ShippingDetail::findOrFail($value['id'])
         ->update([
          'company_id' => $value['company_id'],
         ]);
        }
    }

}
