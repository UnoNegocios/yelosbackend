<?php

namespace App\Observers;

use App\Models\QuotationItem;
use App\Actions\Sales\CalculateSaleValues;
use Illuminate\Support\Facades\Log;

class QuotationItemObserver
{
    /**
     * Handle the QuotationItem "created" event.
     *
     * @param  \App\Models\QuotationItem  $quotationItem
     * @return void
     */
    public function created(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Handle the QuotationItem "updated" event.
     *
     * @param  \App\Models\QuotationItem  $quotationItem
     * @return void
     */
    public function updated(QuotationItem $quotationItem)
    {
        //CalculateSaleValues::calculate($quotationItem);
        Log::debug($quotationItem->quotation);
        /*$this->sale->update([
            'total' => '',
            'subtotal' => '',
            'iva'=> '',
        ]);*/
    }

    /**
     * Handle the QuotationItem "deleted" event.
     *
     * @param  \App\Models\QuotationItem  $quotationItem
     * @return void
     */
    public function deleted(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Handle the QuotationItem "restored" event.
     *
     * @param  \App\Models\QuotationItem  $quotationItem
     * @return void
     */
    public function restored(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Handle the QuotationItem "force deleted" event.
     *
     * @param  \App\Models\QuotationItem  $quotationItem
     * @return void
     */
    public function forceDeleted(QuotationItem $quotationItem)
    {
        //
    }
}
