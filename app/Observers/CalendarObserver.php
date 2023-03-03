<?php

namespace App\Observers;

use App\Models\Calendar;
use Illuminate\Support\Facades\Log;

class CalendarObserver
{
    /**
     * Handle the Calendar "created" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function created(Calendar $calendar)
    {
        if(!$calendar->company_id == null)
        $calendar->company->update(['activity_indicator' => $calendar->company->getActivityIndicator()]);
        else{

        }
    }

    /**
     * Handle the Calendar "updated" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function updated(Calendar $calendar)
    {
        if(!$calendar->company_id == null)
        $calendar->company->update(['activity_indicator' => $calendar->company->getActivityIndicator()]);
        else{
        }
    }

    /**
     * Handle the Calendar "deleted" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function deleted(Calendar $calendar)
    {
        if(!$calendar->company_id == null)

        $calendar->company->update(['activity_indicator' => $calendar->company->getActivityIndicator()]);
        else{
        }
    }

    /**
     * Handle the Calendar "restored" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function restored(Calendar $calendar)
    {
        //
    }

    /**
     * Handle the Calendar "force deleted" event.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return void
     */
    public function forceDeleted(Calendar $calendar)
    {
        //
    }
}
