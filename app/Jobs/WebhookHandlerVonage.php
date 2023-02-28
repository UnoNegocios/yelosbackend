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
use App\Models\Lead;


class WebhookHandlerVonage extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      /*   $test = new Lead();
        $test->payload = $this->webhookCall->payload;
        $test->subject_type = $this->webhookCall->payload['from']['type']; */
        //Log::debug($this->webhookCall->payload);
       // $test->save();  
        
    }
}
