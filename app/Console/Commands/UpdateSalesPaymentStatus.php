<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\Sales\CheckSalesPaymentStatusAction;
use Illuminate\Support\Facades\Log;
use App\Models\Quotation;


class UpdateSalesPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales:paymentstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if the sale days without being paid is greater than the company credit days.';

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

        $companies = Quotation::where('status', 'vendido')->each(function ($item){
            $item->update(['payment_status' => $item->getPaymentStatus()]);
        });

       /* $items = [];
        $sales = Quotation::all();
        foreach($sales as $sale) {
            $sale_status = $sale->getPaymentStatus();
            $sale->update([
                'payment_status' => $sale_status
            ]);
            $items[] = $sale_status;

           }
        Log::debug($items);
        */

    }
}
