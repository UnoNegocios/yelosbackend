<?php

namespace App\Actions\Sales;

use App\Models\Inventory;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\QuotationItem;

class CancelSale
{

    public function __construct()
    {

    }

    public function excecute($request)
    {      
        $this->changeSaleStatus($request);
        $this->updateInventory($request);
    }

    public function changeSaleStatus($request)
    {
       $quotation = Quotation::findOrFail($request->id)
       ->update([
           'status' => $request->status,
           'rejection_comment' => $request->rejection_comment
       ]);
    }

    public function updateInventory($request)
    {
        $data = $request->items;
        foreach($data as $key => $value){
            if($value['rejection_status'] == 'Devolución'){
                $inventory = new Inventory();
                $inventory->created_by_user_id = $request['last_updated_by_user_id'];
                $inventory->type = 'Devolución';
                $inventory->item_id = $value['item']['id'];
                $inventory->quantity = ($value['quantity'])*(-1);
                $inventory->sale_id = $request['id'];
                $inventory->save();
            }
            $updatedItem = QuotationItem::findOrFail($value['id']); 
            $updatedItem->rejection_status = $value['rejection_status'];
            $updatedItem->save();
        }
    }
}