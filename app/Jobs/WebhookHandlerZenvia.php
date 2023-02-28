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
use App\Models\MessageStatus;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Company;
use App\Models\Contact;
use App\Events\Test;





class WebhookHandlerZenvia extends ProcessWebhookJob implements ShouldQueue
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
        
        
        if($data['type'] === 'MESSAGE_STATUS'){
          $status = new MessageStatus();
          $status->messageId = $data['messageId'];
          $status->code = $data['messageStatus']['code'];
          $status->zenvia_timestamp = $data['messageStatus']['timestamp'];
          $status->save();
        }
        else{
          if(
            ($data['message']['channel']==='whatsapp' && 
            count(Conversation::where('phone',$data['message']['from'])->get())===0) ||
            ($data['message']['channel']==='facebook' &&
            count(Conversation::where('facebookId',$data['message']['from'])->get())===0) ||
            ($data['message']['channel']==='instagram' &&
            count(Conversation::where('instagramId',$data['message']['from'])->get())===0)
            
            ){
            $conversation = new Conversation();
            $conversation->client_name = $data['message']['visitor']['name'];
            if($data['message']['channel']==='whatsapp'){
              if($data['message']['direction']==='IN'){
                $conversation->phone = $data['message']['from'];
              }else{
                $conversation->phone = $data['message']['to'];
              }
              $empresa = Company::where('phone', $conversation->phone)->get();
              $contacto = Contact::where('phone', $conversation->phone)->get();
              if(count($empresa)>0){
                $conversation->company_id = $empresa[0]->id;
              }
              if(count($contacto)>0){
                $conversation->contact_id = $contacto[0]->id;
              }
            }else if($data['message']['channel']==='facebook'){
              $conversation->client_picture = $data['message']['visitor']['picture'];
              if($data['message']['direction']==='IN'){
                $conversation->facebookId = $data['message']['from'];
              }else{
                $conversation->facebookId = $data['message']['to'];
              }
            } else if($data['message']['channel']==='instagram'){
              $conversation->client_picture = $data['message']['visitor']['picture'];
              if($data['message']['direction']==='IN'){
                $conversation->instagramId = $data['message']['from'];
              }else{
                $conversation->instagramId = $data['message']['to'];
              }
            } 
            $conversation->save();
          }

          $reciving = new Message();
          if($data['message']['channel']==='whatsapp'){
            $reciving->conversation_id = Conversation::where('phone',$data['message']['from'])->get()[0]['id'];
          }
          if($data['message']['channel']==='facebook'){ 
            $reciving->conversation_id = Conversation::where('facebookId',$data['message']['from'])->get()[0]['id'];
          }
          if($data['message']['channel']==='instagram'){ 
            $reciving->conversation_id = Conversation::where('instagramId',$data['message']['from'])->get()[0]['id'];
          }
          $reciving->contents = $data['message']['contents'][0];
          $reciving->from = $data['message']['from'];
          $reciving->to = $data['message']['to'];
          $reciving->direction = $data['message']['direction'];
          $reciving->channel = $data['message']['channel'];
          $reciving->name = $data['message']['visitor']['name'];
          $reciving->zenvia_timestamp = $data['message']['timestamp'];
          if($data['message']['channel']!=='facebook'&&$data['message']['direction']==='IN'){
            $reciving->messageId = $data['message']['id'];
          }
          $reciving->save();
          broadcast(new Test());

        } 
        
        //Log::debug($data);
    }
}
