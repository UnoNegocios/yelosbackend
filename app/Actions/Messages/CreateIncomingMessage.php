<?php
namespace App\Actions\Messages;

use App\Models\Message;
use Illuminate\Support\Facades\Log;
use App\Models\Conversation;

class CreateIncomingMessage
{
    public function execute($data)
    {
        $message = new Message();
        $message->uuid = $data['message']['id'];
        $message->contents = $data['message']['contents'][0]; 
        $message->direction = $data['message']['direction'];
        $message->channel = $data['message']['channel'];
        $message->from = $data['message']['from'];
        $message->to = $data['message']['to'];
        $message->zenvia_timestamp = $data['message']['timestamp'];

        $message->conversation_id = Conversation::where('channelId', $data['message']['from'] )->get()[0]->id;

        $message->save();
        //broadcast(new Test());
    }
}