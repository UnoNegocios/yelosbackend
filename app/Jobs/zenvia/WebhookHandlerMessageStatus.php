<?php

namespace App\Jobs\zenvia;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\ProcessWebhookJob;
use Illuminate\Support\Facades\Log;
use App\Models\MessageStatus;
use App\Models\Message;
use App\Events\Test;

class WebhookHandlerMessageStatus extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->webhookCall['payload'];
        Log::debug($data);
        if($data['type'] === 'MESSAGE_STATUS'){
          $status = new MessageStatus();
          $status->message_id = $data['messageId'];
          $status->code = $data['messageStatus']['code'];
          $status->zenvia_timestamp = $data['messageStatus']['timestamp'];
          $status->save();
        }
    }
}