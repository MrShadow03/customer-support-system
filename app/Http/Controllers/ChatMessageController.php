<?php

namespace App\Http\Controllers;

use App\Events\NewMessageCreated;
use App\Models\ChatMessage;
use App\Http\Requests\StoreChatMessageRequest;
use App\Http\Requests\UpdateChatMessageRequest;
use App\Http\Resources\ChatMessagesResource;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Ticket $ticket) {
        Gate::authorize("view", $ticket);

        return ChatMessagesResource::collection($ticket->chatMessages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Ticket $ticket, StoreChatMessageRequest $request){
        $message = ChatMessage::create([
            "user_id" => auth()->user()->id,
            "ticket_id"=> $ticket->id,
            "message" => $request->message,
        ]);

        broadcast(new NewMessageCreated($message));

        return response()->json([
            "message"=> "Message sent successfully",
            "chatMessage" => $message
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatMessageRequest $request, ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMessage $chatMessage)
    {
        //
    }
}
