<?php

namespace App\Http\Controllers\api\v2\sale;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Item;
use App\Http\Controllers\Controller;

class MakePosSale extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $quotation = new Quotation();

        $quotation->company_id = $request->company_id;
        $quotation->user_id = $request->user_id;
        $quotation->note = $request->note;
        $quotation->items = $request->items;
        $quotation->status = $request->status;
        $quotation->date = $request->date;
        $quotation->bar = $request->bar;
        $quotation->iva = $request->iva;
        $quotation->subtotal = $request->subtotal;
        $quotation->total = $request->total;
        $quotation->created_by_user_id = $request->created_by_user_id;
        $quotation->last_updated_by_user_id = $request->last_updated_by_user_id;

        $quotation->save();

        $data = $request['items'];
        foreach($data as $key => $value){
            $item = $value['item'];
            $item_data = Item::findOrFail($item);
            $quotation_items = new QuotationItem();
            $quotation_items->quotation_id = $id;
            $quotation_items->quantity = $value['quantity'];
            $quotation_items->item_id = $item_data['id'];
            $quotation_items->value = $item_data['price'];
            $quotation_items->price = $value['price'];
            $quotation_items->cost = $item_data['cost'];
            $quotation_items->save();
        }

        return $quotation->id;


    }
}
