<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use App\Role;
use App\Status;
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
    public function claim(User $user, Ticket $ticket){
        return $user->role->naam == Role::EERSTELIJNSMEDEWERKERS && $ticket->status->name == Status::EERSTELIJN || $user->role->naam == Role::TWEEDELIJNSMEDEWERKERS&& $ticket->status->name == Status::TWEEDELIJN;
    }
    public function unclaim(User $user, Ticket $ticket){
        return $user->role->naam == Role::EERSTELIJNSMEDEWERKERS && $ticket->status->name == Status::EERSTELIJN_TOEGEWEZEN || ($user->role->naam == Role::TWEEDELIJNSMEDEWERKERS && $ticket->status->name == Status::TWEEDELIJN_TOEGEWEZEN);
    }
    public function escalate(User $user, Ticket $ticket){
        return $user->role->naam == Role::EERSTELIJNSMEDEWERKERS && $ticket->status->name == Status::EERSTELIJN_TOEGEWEZEN;
    }
    public function deescalate(User $user, Ticket $ticket){
        return $user->assigned_tickets->contains($ticket) && $user->role->naam == Role::TWEEDELIJNSMEDEWERKERS && $ticket->status->name == Status::TWEEDELIJN_TOEGEWEZEN;
    }

}
