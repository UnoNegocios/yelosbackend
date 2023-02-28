<?php

namespace App\Http\Controllers\api\v1\quotation;

use App\Models\QuotationItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotationItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        QuotationItem::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quotation_detail = new QuotationItem();
        $quotation_detail->quantity = $request->quantity;
        $quotation_detail->value = $request->value;
        $quotation_detail->price = $request->price;
        $quotation_detail->cost = $request->cost;
        $quotation_detail->quotation_id = $request->quotation_id;
        $quotation_detail->item_id = $request->item_id;
        $quotation_detail->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuotationItem  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function show(QuotationItem $quotationDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuotationItem  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(QuotationItem $quotationDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuotationItem  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuotationItem $quotationDetail)
    {
        $quotation_detail = QuotationItem::findOrFail($request->id);
        $quotation_detail->quantity = $request->quantity;
        $quotation_detail->value = $request->value;
        $quotation_detail->price = $request->price;
        $quotation_detail->cost = $request->cost;
        $quotation_detail->quotation_id = $request->quotation_id;
        $quotation_detail->item_id = $request->item_id;
        $quotation_detail->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuotationItem  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $quotation_detail = QuotationItem::destroy($request->id);
        return $quotation_detail;
    }

    public function bulkCreate(Request $request) {
        $data = $request->all();
     
         foreach ($data as $key => $value) {

            QuotationItem::create([
               'quantity' => $data[$key]['quantity'],
               'value' => $data[$key]['value'],
               'price' => $data[$key]['price'],
               'cost' => $data[$key]['cost'],
               'quotation_id' => $data[$key]['quotation_id'],
               'item_id' => $data[$key]['item_id'],
               'created_at' => $data[$key]['created_at'],
               'updated_at' => $data[$key]['updated_at']
           ]);

           };

        }
}
