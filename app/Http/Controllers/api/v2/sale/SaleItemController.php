<?php

namespace App\Http\Controllers\api\v2\sale;

use Illuminate\Http\Request;

use App\Models\QuotationItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\quotation\QuotationItemMinResource;
use App\Http\Requests\sale\StoreSaleItemRequest;
use App\Http\Requests\sale\UpdateSaleItemRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\SaleFilter;
use App\Actions\Sales\CancelSale;
use App\Models\Item;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuotationItem::all();
    }

    public function sales(Request $request)
    {
        return QuotationItemResource::collection(
        QuotationItem::orderBy('date', 'DESC')
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
    public function store(StoreSaleItemRequest $request)
    {
        $validated = $request->validated();
        $item_data = Item::findOrFail($request->item_id);
        //return $item_data->price;
        $sale = QuotationItem::create([
            'value' => $item_data->price,
            'cost' => $item_data->cost,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'quotation_id' => $request->quotation_id,
            'item_id' => $request->item_id,
            //$validated,
        ]);
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(QuotationItem $sale_item)
    {   
        return $sale_item;
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
    public function update(QuotationItem $sale_item, UpdateSaleItemRequest $request)
    {
        $validated = $request->validated();
        $item_data = Item::findOrFail($request->item_id);
        //return $item_data->price;
        $sale_item->update([
            'value' => $item_data->price,
            'cost' => $item_data->cost,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'quotation_id' => $request->quotation_id,
            'item_id' => $request->item_id,
            //$validated,
        ]);
        return response(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        QuotationItem::findOrFail($request)->delete();
        return response(null, 204);
    }
}
