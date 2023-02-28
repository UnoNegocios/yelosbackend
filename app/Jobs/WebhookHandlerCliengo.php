<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\ProcessWebhookJob;
use Illuminate\Support\Facades\Log;
use App\Actions\Leads\CreateCliengoLead;


class WebhookHandlerCliengo extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Log::debug($this->webhookCall->payload);
        $lead = new CreateCliengoLead();
        $lead->execute($this->webhookCall->payload);
    }
}
