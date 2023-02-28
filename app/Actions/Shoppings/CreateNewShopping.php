<?php

namespace App\Actions\Shoppings;
use App\Models\Inventory;
use App\Models\Shopping;
use Illuminate\Support\Facades\Log;
use App\Models\ShoppingDetail;


class CreateNewShopping
{

    public function __construct()
    {

    }

    public function excecute($request)
    {      
        $this->createNewShopping($request);
    }

    public function createNewShopping($request)
    {
       //$data = Shopping::create($request->all());
       $shopping = new Shopping();

       $shopping->date = $request->date;
       $shopping->serie = $request->serie;
       $shopping->provider_id = $request->provider_id;
       $shopping->invoice = $request->invoice;
       $shopping->due_date = $request->due_date;
       $shopping->notes = $request->notes;
       $shopping->pdf = $request->pdf;
       $shopping->xml = $request->xml;
       $shopping->iva_percentage = $request->iva_percentage;
       $shopping->isr_percentage = $request->isr_percentage;
       $shopping->created_by_user_id = $request->created_by_user_id;
       $shopping->last_updated_by_user_id = $request->last_updated_by_user_id;

        $shopping->save();
        $data = $shopping;

        $this->createShoppingDetail($request, $data->id);
    }

    public function createShoppingDetail($request, $id)
    {
        $data = $request['products'];
        foreach($data as $key => $value){
            $shopping_detail = new ShoppingDetail();
            $shopping_detail->shopping_id = $id;
            $shopping_detail->item_id = $value['item_id'];
            $shopping_detail->quantity = $value['quantity'];
            $shopping_detail->unit_cost = $value['unit_cost'];
            $shopping_detail->created_by_user_id = $request->created_by_user_id;
            $shopping_detail->last_updated_by_user_id = $request->last_updated_by_user_id;
            $shopping_detail->save();
        }
    }
}