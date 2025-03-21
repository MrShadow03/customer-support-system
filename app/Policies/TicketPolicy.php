<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->hasRole("admin") || $user->id === $ticket->user_id ? Response::allow() : Response::deny("You do not own this ticket.");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasRole("customer") ? Response::allow() : Response::deny("You are not authorized to create a ticket.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->hasRole("admin") || $user->id === $ticket->user_id ? Response::allow() : Response::deny("You are not authorized to create a ticket.");;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->hasRole("admin") || $user->id === $ticket->user_id ? Response::allow() : Response::deny("You are not authorized to create a ticket.");;
    }
}
