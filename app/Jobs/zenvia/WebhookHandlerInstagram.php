<?php

namespace App\Jobs\zenvia;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\ProcessWebhookJob;
use App\Actions\Messages\CheckIncomingMessage;
use App\Actions\Messages\CreateIncomingMessage;
use App\Actions\Conversations\CreateConversation;
use App\Actions\Leads\CreateLead;
use Illuminate\Support\Facades\Log;






class WebhookHandlerInstagram extends ProcessWebhookJob implements ShouldQueue
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
      if(CheckIncomingMessage::isFirstContact($data)){
              $lead_id = CreateLead::execute($data); //crear lead
              CreateConversation::execute($data, null, $lead_id);//crear conversación 
      }
      $message = CreateIncomingMessage::execute($data);//no es primer contacto, crea nuevo mensaje
    }
}
