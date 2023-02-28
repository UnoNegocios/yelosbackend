<?php

namespace App\Listeners;

use App\Events\OrderDispatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;

class UpdateSaleDispatched
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
        $sale = Quotation::findOrFail($event->quotation->id)
        ->update([
            'production_dispatched' => 1
        ]);
    }
}
