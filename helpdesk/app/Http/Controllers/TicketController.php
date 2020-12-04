<?php

namespace App\Http\Controllers;

use App\Role;
use App\Status;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    Deze method moet de gegevens uit de request valideren en dan afhankelijk daarvan:
    -	redirecten naar ticket_create (met foutmeldingen)
    -	ticket bewaren, en redirecten naar ticket_index (met succesmelding)

     */
    public static function index(){
        $tickets = Auth::user()->submitted_tickets()->orderBy('created_at', 'DESC')->get();

        return view('ticket.index', ['tickets' => $tickets]);
    }

    /**
    Deze method moet een view retourneren
    met een formulier om een ticket te maken.
    Naam voor de view bijv.: ticket/create.blade.php
     */
    public function create(){
        $this->authorize('create', Ticket::class);
        return view('ticket.create');
    }
    /**
    Deze method moet een view retourneren
    met een formulier om een ticket te maken.
    Naam voor de view bijv.: ticket/create.blade.php
     */
    public function save(Request $request){
        $this->authorize('create', Ticket::class);

        $request->validate(
            [
                'title'         => 'required|max:191',
                'description'   => 'required'
            ]
        );

        $status = Status::where('name', Status::EERSTELIJN)->first();
        $ticket = new Ticket();

        $ticket->title = $request->title;
        $ticket->description = $request->description;

        $ticket->status()->associate($status);
        $request->user()->submitted_tickets()->save($ticket);

        return redirect()->route('ticket_index_customer')->with('succes', 'Your ticket is saved...');
    }

    /**
    Deze method moet het ticket met id $id ophalen, samen met
    alle comments erop, en een view retourneren met dat ticket
    en de comments. Naam voor de view bijv.: ticket/show.blade.php
    */

    public function show($id){
        $ticket = Ticket::findOrFail($id);
        $this->authorize('show', $ticket);
        return view('ticket.show', ['ticket' => $ticket]);
    }

    public function close($id){
        $ticket = Ticket::findOrFail($id);

        $this->authorize('close', Ticket::class);

        $afgehandeld = Status::AFGEHANDELD;

        $afgehandeld->user()->submitted_tickets()->save($ticket);

        return redirect()->back()->with('succes', __('Ticket is closed'));

    }

    public function claim($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('claim', $ticket);

        $ticketStatus = $ticket->status->name;
        switch ($ticketStatus) {
            case Status::EERSTELIJN:
                $status = Status::where('name', Status::EERSTELIJN_TOEGEWEZEN)->first();
                break;
            case Status::TWEEDELIJN:
                $status = Status::where('name', Status::TWEEDELIJN_TOEGEWEZEN)->first();
                break;
        }

        $ticket->status()->associate($status);
        Auth::user()->assigned_tickets()->attach($id);
        $ticket->save();

        return redirect()->back()->with('succes', 'Your ticket has been assigned...');

    }


    public function index_helpdesk()
    {
        $this->authorize('assign', Ticket::class);

        $user = Auth::user();

        $assigned_tickets = $user->assigned_tickets;
        if ($user->role->naam == Role::EERSTELIJNSMEDEWERKERS) {
            $statusNaam = Status::EERSTELIJN;
        } elseif ($user->role->naam == Role::TWEEDELIJNSMEDEWERKERS) {
            $statusNaam = Status::TWEEDELIJN;
        }
        $status = Status::where('name', $statusNaam)->first();
        $unassigned_tickets = $status->tickets;

        return view(
            'ticket.index_helpdesk',
            [
                'assigned_tickets' => $assigned_tickets,
                'unassigned_tickets' => $unassigned_tickets
            ]
        );
    }


}
