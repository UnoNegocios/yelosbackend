<?php

namespace App\Http\Controllers\api\v1\quotation;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\OrderToFillCreated;
use App\Events\OrderDispatched;
use App\Actions\Quotations\CreateNewQuotation;
use App\Http\Resources\quotation\QuotationResource;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewQuotation")){
            $quotation = Quotation::orderBy('date', 'DESC')->where('date', '>=', '2022-01-01')->with('quotationItems')->get();
        }else{
            $quotation = Quotation::where('user_id', Auth::user()->id)->orderBy('date', 'DESC')->where('date', '>=', '2022-01-01')->with('quotationItems')->get();
        }
        return $quotation;
    }
    public function quotations()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewQuotation")){
            $quotation = Quotation::where('status', "quotation")->orderBy('created_at', 'DESC')->get();
        }else{
            $quotation = Quotation::where('user_id', Auth::user()->id)->where('status', "quotation")->get();
        }
        return $quotation;
    }
    public function sales()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewSales")){
            $quotation = Quotation::where('status', "vendido")->where('date', '>=', '2022-01-01')->get();
        }else{
            $quotation = Quotation::where('user_id', Auth::user()->id)->where('status', "vendido")->orderBy('date', 'DESC')->where('date', '>=', '2022-01-01')->get();
        }
        return $quotation;
    }
    public function cancellations()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewCancelations")){
            $quotation = Quotation::where('status', "cancelado")->orderBy('updated_at', 'DESC')->get();
        }else{
            $quotation = Quotation::where('user_id', Auth::user()->id)->where('status', "cancelado")->orderBy('updated_at', 'DESC')->get();
        }
        return $quotation;
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

        $new = new CreateNewQuotation();
        $new->excecute($request);
       
       /* $quotation = new Quotation();

        $quotation->company_id = $request->company_id;
        $quotation->user_id = $request->user_id;
        $quotation->pdf = $request->pdf;
        $quotation->note = $request->note;
        $quotation->contact_id = $request->contact_id;
        $quotation->rejection_id = $request->rejection_id;
        $quotation->items = $request->items;
        $quotation->status = $request->status;
        $quotation->rejection_comment = $request->rejection_comment;

        $quotation->date = $request->date;
        $quotation->bar = $request->bar;
        $quotation->type = $request->type;
        $quotation->iva = $request->iva;
        $quotation->subtotal = $request->subtotal;
        $quotation->total = $request->total;
        $quotation->invoice = $request->invoice;
        $quotation->printed = $request->printed;
        $quotation->invoice_date = $request->invoice_date;
        $quotation->due_date = $request->due_date;
        $quotation->production_dispatched = $request->production_dispatched;
        $quotation->created_by_user_id = $request->created_by_user_id;
        $quotation->last_updated_by_user_id = $request->last_updated_by_user_id;
    

        $quotation->save();
        return $quotation;*/

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $quotation = Quotation::findOrFail($request->id);
        
        $quotation->company_id = $request->company_id;
        $quotation->user_id = $request->user_id;
        $quotation->pdf = $request->pdf;
        $quotation->note = $request->note;
        $quotation->contact_id = $request->contact_id;
        $quotation->rejection_id = $request->rejection_id;
        $quotation->items = $request->items;
        $quotation->status = $request->status;
        $quotation->rejection_comment = $request->rejection_comment;

        $quotation->date = $request->date;
        $quotation->bar = $request->bar;
        $quotation->type = $request->type;
        $quotation->iva = $request->iva;
        $quotation->subtotal = $request->subtotal;
        $quotation->total = $request->total;
        $quotation->invoice = $request->invoice;
        $quotation->invoice_date = $request->invoice_date;
        $quotation->due_date = $request->due_date;
        $quotation->created_by_user_id = $request->created_by_user_id;
        $quotation->last_updated_by_user_id = $request->last_updated_by_user_id;

        $quotation->save();
        return $quotation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illum
     * inate\Http\Response
     */
    public function destroy(Request $request)
    {
        $quotation = Quotation::destroy($request->id);
        return $quotation;  
    }

    public function files(Request $request){
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('../public/files'), $fileName);
        return response()->json(['file' => $fileName]);
    }  

    public function makeSale(Request $request){
        $quotation = Quotation::findOrFail($request->id);
        $quotation->status = $request->status;
        $quotation->save();
        OrderToFillCreated::dispatch($quotation);
        return $quotation; 
    }

    public function barSalesBulkUpdate(Request $request) {
        $data = $request->all();

        foreach ($data as $key => $value) {
      
         $perro = Quotation::findOrFail($value['id'])
         ->update([
          'invoice' => $value['invoice'],
          'invoice_date' => $value['invoice_date']
         ]);
        }
    }

    public function dispatchSale(Request $request)
    {
        OrderDispatched::dispatch($request);
    }
}