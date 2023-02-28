<?php

namespace App\Actions\Conversations;

use App\Models\Conversation;
use App\Models\CreateNewMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use App\Actions\Chatbot\ChatbotFirstInteraction;

class CreateConversation
{
    public static function execute($data, $client_id, $lead_id){
        $conversation = new Conversation();
        $conversation->client_name = $data['message']['visitor']['name'];
        $conversation->channel = $data['channel'];
        $conversation->channelId = $data['message']['from'];
        if(Arr::exists($data['message']['visitor'],'firstName')){
            $conversation->first_name = $data['message']['visitor']['firstName'];
        }else{
            $conversation->first_name = $data['message']['visitor']['name'];
        }
        if(Arr::exists($data['message']['visitor'],'lastName')){
            $conversation->last_name = $data['message']['visitor']['lastName'];
        }else{
            $conversation->client_name = $data['message']['visitor']['userName'];
        }
        if(Arr::exists($data['message']['visitor'],'picture')){
            $conversation->client_picture = $data['message']['visitor']['picture'];
        }if(Arr::exists($data['message']['visitor'],'picture')){
            $conversation->client_picture = $data['message']['visitor']['picture'];
        }
        $conversation->save();
        
        if($client_id){
            $conversation->client_id = $client_id; 
        }else if($lead_id){
            $conversation->lead_id = $lead_id; 
        }

        $conversation->save();

        $chatbot = new ChatbotFirstInteraction();
        $chatbot->execute($data, $conversation->id);

    }
}