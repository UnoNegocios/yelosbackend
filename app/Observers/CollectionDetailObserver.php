<?php

namespace App\Observers;

use App\Models\CollectionDetail;

class CollectionDetailObserver
{
    /**
     * Handle the CollectionDetail "created" event.
     *
     * @param  \App\Models\CollectionDetail  $collectionDetail
     * @return void
     */
    public function created(CollectionDetail $collectionDetail)
    {
        $collectionDetail->sale->update(['payment_status' => $collectionDetail->sale->getPaymentStatus()]);
    }

    /**
     * Handle the CollectionDetail "updated" event.
     *
     * @param  \App\Models\CollectionDetail  $collectionDetail
     * @return void
     */
    public function updated(CollectionDetail $collectionDetail)
    {
        $collectionDetail->sale->update(['payment_status' => $collectionDetail->sale->getPaymentStatus()]);
    }

    /**
     * Handle the CollectionDetail "deleted" event.
     *
     * @param  \App\Models\CollectionDetail  $collectionDetail
     * @return void
     */
    public function deleted(CollectionDetail $collectionDetail)
    {
        $collectionDetail->sale->update(['payment_status' => $collectionDetail->sale->getPaymentStatus()]);
    }

    /**
     * Handle the CollectionDetail "restored" event.
     *
     * @param  \App\Models\CollectionDetail  $collectionDetail
     * @return void
     */
    public function restored(CollectionDetail $collectionDetail)
    {
        //
    }

    /**
     * Handle the CollectionDetail "force deleted" event.
     *
     * @param  \App\Models\CollectionDetail  $collectionDetail
     * @return void
     */
    public function forceDeleted(CollectionDetail $collectionDetail)
    {
        //
    }
}
