<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Ticket $ticket){
        return $user->id == $ticket->user_id || $user->role->naam == Role::EERSTELIJNSMEDEWERKERS || $user->role->naam == Role::TWEEDELIJNSMEDEWERKERS;
    }

    public function create(User $user){
        return $user->role->naam == Role::USER;
    }

    public function assign(User $user){
        return $user->role->naam == Role::EERSTELIJNSMEDEWERKERS || $user->role->naam == Role::TWEEDELIJNSMEDEWERKERS;
    }
    public function comment(User $user, Ticket $ticket){
        return $user->id == $ticket->user_id || $user->assigned_tickets->contains($ticket) && $ticket->isOpen();
    }
    public function close(User $user, Ticket $ticket){
        return $user->id == $ticket->user_id || $user->assigned_tickets->contains($ticket) && $ticket->isOpen();
    }


}
