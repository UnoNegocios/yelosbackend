<?php

namespace App\Http\Controllers\api\v2\quotation;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Resources\quotation\QuotationResource;
use App\Http\Requests\quotation\StoreQuotationRequest;
use App\Http\Requests\quotation\UpdateQuotationRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\QuotationFilter;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return QuotationFilter::excecute($request);
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
    public function store(StoreQuotationRequest $request)
    {
        $validated = $request->validated();
        
        $quotation = Quotation::create(
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
    public function show(Quotation $quotation)
    {
        return new QuotationResource($quotation);
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
    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        $validated = $request->validated();
        $quotation->update($validated);
        return $quotation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        return response(null, 204);
    }
}
