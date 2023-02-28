<?php

namespace App\Http\Controllers\api\v1\message_status;

use App\Models\MessageStatus;
use App\Models\Message;
use App\Models\Conversations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MessageStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $messages = Message::where('conversation_id', $request->id)->where('messageId', '!=', null)->orderBy('created_at', 'DESC')->get();

        $status = MessageStatus::where('messageId', $messages[0]->messageId)->get();


        foreach($messages as $key => $message){
            if($key > 0){
                $status = $status->push(MessageStatus::where('messageId', $message->messageId)->get());
            }
        }

        Log::debug($status);
        
        return $status;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageStatus  $messageStatus
     * @return \Illuminate\Http\Response
     */
    public function show(MessageStatus $messageStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageStatus  $messageStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageStatus $messageStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageStatus  $messageStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageStatus $messageStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageStatus  $messageStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageStatus $messageStatus)
    {
        //
    }
}
