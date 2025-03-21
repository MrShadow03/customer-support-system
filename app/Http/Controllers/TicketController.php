<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tickets = Ticket::all();

        if (auth()->user()->hasRole("customer")) {
            $tickets = auth()->user()->tickets;
        }

        return $tickets;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request) {
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
        if (auth()->user()->hasRole('admin') || $ticket->user_id === auth()->id()) {
            return response()->json([
                'message' => 'Ticket retrieved successfully.',
                'ticket' => $ticket,
            ]);
        };

        return response()->json([
            'message' => 'You are not authorized to view this ticket.',
        ], 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket) {
        if (auth()->user()->hasRole('admin') || $ticket->user_id === auth()->id()) {
            $ticket->update($request->validated());
    
            return response()->json([
                'message' => 'Ticket updated successfully.',
                'ticket' => $ticket,
            ]);
        }
    
        return response()->json([
            'message' => 'You are not authorized to update this ticket.',
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket) {
        if (auth()->user()->hasRole('admin') || $ticket->user_id === auth()->id()) {
            $ticket->delete();
    
            return response()->json([
                'message' => 'Ticket deleted successfully.',
            ]);
        }
    
        return response()->json([
            'message' => 'You are not authorized to delete this ticket.',
        ], 403);
    }
}
