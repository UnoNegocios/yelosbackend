<?php

namespace App\Http\Controllers\api\v2\sale;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Resources\quotation\QuotationResource;
use App\Http\Requests\sale\StoreQuotationRequest;
use App\Http\Requests\quotation\UpdateQuotationRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\SaleFilter;
use App\Actions\Sales\CancelSale;
use App\Actions\Quotations\CreateNewQuotation;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return SaleFilter::excecute($request);
    }

    public function sales(Request $request)
    {
        return QuotationResource::collection(
        Quotation::where('created_at', '>=', now()->subDays(30)->endOfDay())
        ->where('status', 'vendido')
        ->orderBy('date', 'DESC')
        ->paginate($request->itemsPerPage));
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
    public function store(Request $request, CreateNewQuotation $createNewQuotation)
    {
        $createNewQuotation = new CreateNewQuotation();
       return $createNewQuotation->excecute($request);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $sale)
    {
        return new QuotationResource($sale);
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
    public function update(UpdateQuotationRequest $request, Quotation $sale)
    {
        $validated = $request->validated();
        $sale->update($validated);
        $sale->shippingDetail->update(['invoice' => $validated['invoice']]);
        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $sale)
    {
        $sale->delete();
        return response(null, 204);
    }

    public function cancelSale(Request $request)
    {
        //return 'perro'; 
        $sale = new CancelSale();
        $sale->excecute($request);
    }

    public function items(Request $request)
    {
        $sale = Quotation::findOrFail($request->id);
        return $sale->quotationItems;
    }

    public function barSales()
    {
        //$sale = Quotation::all();
        $sales = Quotation::where('invoice', null)
        ->where('bar', '1')
        ->orderBy('date', 'DESC')
        ->get();

        return QuotationResource::collection($sales);
    }
}
