<?php

namespace App\Actions\Shoppings;

use App\Models\Inventory;
use App\Models\Shopping;
use Illuminate\Support\Facades\Log;
use App\Models\ShoppingDetail;

class MarkShoppingAsReceivedAction{

    public function __construct()
    {

    }

    public function excecute($request)
    {      
        $this->markShoppingAsReceived($request);
        $this->addInventory($request);

    }

    public function markShoppingAsReceived($request){
        $shopping = Shopping::findOrFail($request->id)
        ->update([
            'received' => 1,
            'last_updated_by_user_id' => $request->last_updated_by_user_id
        ]);
    }

    public function addInventory($request){
        $shoppingDetails = Shopping::findOrFail($request->id)->shoppingDetail;
        //Log::debug($shoppingDetails);

       foreach ($shoppingDetails as $key => $value) {
            
            Inventory::create([
              'item_id' => $value['item_id'],
              'type' => 'Entrada Compra',
              'quantity' => $value['quantity'],
              'inventory' => $value['inventory'],
              'created_by_user_id' => $request->last_updated_by_user_id,
              'shopping_id' => $request->id,
              'last_updated_by_user_id' => $request->last_updated_by_user_id
          ]);

          }
    }



}