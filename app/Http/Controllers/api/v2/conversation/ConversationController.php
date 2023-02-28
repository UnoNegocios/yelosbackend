<?php

namespace App\Http\Controllers\api\v2\conversation;

use Illuminate\Http\Request;
use App\Http\Requests\conversation\StoreConversationRequest;
use App\Http\Requests\conversation\UpdateConversationRequest;
use App\Models\Conversation;
use App\Http\Controllers\Controller;
use App\Http\Filters\conversation\ConversationFilter;
use App\Http\Resources\conversation\ConversationResource;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Conversation::all();
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
     * @param  \App\Http\Requests\StoreConversationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConversationRequest $request)
    {
        $validated = $request->validated();
        
        $call = Conversation::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        return new ConversationResource($conversation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConversationRequest  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConversationRequest $request, Conversation $conversation)
    {
        $validated = $request->validated();
        
        $conversation->update($validated);
        return response(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        $conversation->delete();
        return response(null, 204);
    }
}
