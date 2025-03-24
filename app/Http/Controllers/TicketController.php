<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\ChatMessagesResource;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Ticket::query();
    
        if (auth()->user()->hasRole("customer")) {
            $query = auth()->user()->tickets();
        }
    
        $tickets = $query->with('user')->latest()->paginate(5);
    
        $tickets->getCollection()->transform(function($ticket) {
            $ticket->user_name = $ticket->user ? $ticket->user->name : null;
            return $ticket;
        });
    
        return $tickets;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request) {
        Gate::authorize("create", Ticket::class);
        
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'priority' => $request->input('priority'),
            'attachment' => $request->file('attachment') ? $request->file('attachment')->store('attachments') : null,
        ]);

        return response()->json([
            'message' => 'Ticket created successfully.',
            'ticket' => $ticket,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket) {
        Gate::authorize('view', $ticket);

        return response()->json([
            'message' => 'Ticket retrieved successfully.',
            'ticket' => $ticket,
            'user' => $ticket->user,
            'chatMessages' => ChatMessagesResource::collection($ticket->chatMessages)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket) {
        Gate::authorize('update', $ticket);

        $ticket->update($request->validated());

        return response()->json([
            'message' => 'Ticket updated successfully.',
            'ticket' => $ticket,
        ]);
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket) {
        Gate::authorize('delete', $ticket);

        $ticket->delete();

        return response()->json([
            'message' => 'Ticket deleted successfully.',
        ]);
    }
}
