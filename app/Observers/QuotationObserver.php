<?php

namespace App\Observers;

use App\Models\Quotation;
use App\Events\OrderToFillCreated;
use App\Actions\Quotations\CreateQuotationDetail;
use Illuminate\Support\Facades\Log;



class QuotationObserver
{
    /**
     * Handle the quotation "created" event.
     *
     * @param  \App\Quotation  $user
     * @return void
     */
    public function created(Quotation $quotation)
    {
        if($quotation['status'] === 'vendido'){
            OrderToFillCreated::dispatch($quotation);
        };

        $quotation->update(['payment_status' => $quotation->getPaymentStatus()]);
        //$perro = new CreateQuotationDetail();
        //$perro->excecute($quotation);
        

    }

}