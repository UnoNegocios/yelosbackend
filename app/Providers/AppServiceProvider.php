<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\Observers\QuotationObserver;
use App\Observers\CollectionDetailObserver;
use App\Models\User;
use App\Models\Quotation;
use App\Models\Calendar;
use App\Models\CollectionDetail;
use Illuminate\Support\ServiceProvider;
use App\Observers\CalendarObserver;
use App\Observers\QuotationItemObserver;
use App\Models\QuotationItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Quotation::observe(QuotationObserver::class);
        Calendar::observe(CalendarObserver::class);
        CollectionDetail::observe(CollectionDetailObserver::class);
        QuotationItem::observe(QuotationItemObserver::class);

    }
}
