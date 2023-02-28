<?php

namespace App\Actions\Productions;
use App\Models\Inventory;
use App\Models\Production;
use Illuminate\Support\Facades\Log;
use App\Models\ProductionDetail;



class CreateNewProduction
{

    public function __construct()
    {

    }

    public function excecute($request)
    {      
        $this->createNewProduction($request);
    }

    public function createNewProduction($request)
    {
       //$data = Production::create($request->all());
       $production = new Production();

       $production->date = $request->date;
       $production->created_by_user_id = $request->created_by_user_id;
       $production->updated_by_user_id = $request->updated_by_user_id;
       $production->user_id = $request->user_id;
       $production->status = $request->status;
       $production->start_time = $request->start_time;
       $production->end_time = $request->end_time;


        $production->save();
        $data = $production;

        $this->createProductionDetail($request, $data->id);
    }

    public function createProductionDetail($request, $id)
    {
        $data = $request['production_detail'];
        foreach($data as $key => $value){
            $production_detail = new ProductionDetail();
            $production_detail->production_id = $id;
            $production_detail->item_id = $value['item_id'];
            $production_detail->quantity = $value['quantity'];
            $production_detail->created_by_user_id = $request['created_by_user_id'];
            $production_detail->last_updated_by_user_id = $request['updated_by_user_id'];
            $production_detail->insumos = $value['insumos'];    
            $production_detail->save();
                foreach($value['insumos'] as $key => $insumo)
                {
                    $inventory = new Inventory();
                    $inventory->created_by_user_id = $request['created_by_user_id'];
                    $inventory->type = 'Salida Producción';
                    $inventory->item_id = $insumo['item_id'];
                    $inventory->quantity = $insumo['quantity'];
                    $inventory->production_id = $id;
                    $inventory->save();
                }
                $entry = new Inventory();
                $entry->created_by_user_id = $request['created_by_user_id'];
                $entry->type = 'Entrada Producción';
                $entry->item_id = $value['item_id'];
                $entry->quantity = $value['quantity'];
                $entry->production_id = $id;
                $entry->save();
        }
    }
}