<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class UpdateCompaniesActivityIndicator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:activityindicator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks if each company has future activities and assaigns an indicator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $companies = Company::each(function ($item){
            if(isset($item->calendars->first()->date)){
            $item->update(['activity_indicator' => $item->getActivityIndicator()]);
            }
        });
    }
}
