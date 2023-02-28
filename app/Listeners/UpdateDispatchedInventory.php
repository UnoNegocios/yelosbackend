<?php

namespace App\Listeners;

use App\Events\OrderDispatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;


class UpdateDispatchedInventory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderDispatched  $event
     * @return void
     */
    public function handle(OrderDispatched $event)
    {
        $data = $event->quotation->items;
       foreach($data as $key => $value){
            $inventory = new Inventory();
            $inventory->created_by_user_id = $event->quotation->user_id;
            $inventory->type = 'Salida Venta';
            $inventory->item_id = $value['item'];
            $inventory->quantity = $value['quantity'];
            $inventory->sale_id = $event->quotation->id;
            //$inventory->inventory = 0;
            //$inventory->shopping_id = 2;
            //$inventory->production_id = 2;

            $inventory->save();
        }
    }
}