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
use Illuminate\Support\Facades\Http;
use App\Events\NewLead;





class WebhookHandlerMessenger extends ProcessWebhookJob implements ShouldQueue
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
     //Log::debug($data);
     
      //Log::debug($response);

      if(CheckIncomingMessage::isFirstContact($data)){
              $lead_id = CreateLead::execute($data);      //crea nuevo lead
              CreateConversation::execute($data, null, $lead_id);   //crea conversación e inicia robot 
      }
      
      $message = CreateIncomingMessage::execute($data);     //no es primer contacto, crea nuevo mensaje
    }
    
}
