<?php

namespace App\Actions\Quotations;

use App\Models\Inventory;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\QuotationItem;

class CreateNewQuotation
{

    public function __construct()
    {

    }

    public function excecute($request)
    {      
       return $this->createNewQuotation($request);
    }

    public function createNewQuotation($request)
    {
       //$data = Quotation::create($request->all());
       $quotation = new Quotation();

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
        $data = $quotation;

      return $this->createQuotationItems($request, $data->id);
    }

    public function createQuotationItems($request, $id)
    {
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
        return $id;
    }
}