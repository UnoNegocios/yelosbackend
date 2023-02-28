<?php

namespace App\Actions\Orders;

use App\Models\Inventory;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;

class DispatchQuotationAction
{

    public function __construct()
    {

    }

    public function excecute($request)
    {        
       $this->updateInventory($request);
       $this->updateSaleDispatched($request);
    }

    public function updateInventory($request)
    {
        $data = $request->quotation_items;
        //Log::debug($data['item']);
        foreach($data as $key => $value){
            $inventory = new Inventory();
            $inventory->created_by_user_id = $request->created_by_user_id;
            $inventory->type = 'Salida Venta';
            $inventory->item_id = $value['item_id'];
            $inventory->quantity = $value['quantity'];
            $inventory->sale_id = $request->id;
            //$inventory->inventory = 0;
            //$inventory->shopping_id = 2;
            //$inventory->production_id = 2;

            //Log::debug($inventory);
            $inventory->save();
        }
    }

    public function updateSaleDispatched($request)
    {
        $data = $request->all();
        $sale = Quotation::findOrFail($data['id'])
        ->update([
            'production_dispatched' => 1,
            'is_in_production' => 1
        ]);
    }
}