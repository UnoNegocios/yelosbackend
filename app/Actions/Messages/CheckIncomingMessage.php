<?php

namespace App\Actions\Messages;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Conversation;
use Illuminate\Support\Facades\Log;

class CheckIncomingMessage
{
    public static function isFirstContact($data): bool
    {
        
      if (Conversation::where('channelId', $data['message']['from'] )->exists()){
        return false; 
      }else{
        return true;
      }
    }

    public static function isAlreadyClient($data): string
    {
        $clientPhone = substr($data['message']['from'], -10);
        
        $contact = Contact::where('phone', $clientPhone)->get();
        $client = Client::where('phone', $clientPhone)->get();

        if (count($client)>0){
            return $client->id;
        }else if (count($contact)>0){
            return $contact[0]->client_id;
        }else{
            return false;
        }
    }
}