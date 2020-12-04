<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('comment');
    }

    /**
    Deze method moet de gegevens uit de request valideren en afhankelijk daarvan:
    -	redirecten naar ticket_show (met foutmeldingen)
    -	comment bewaren in de database en redirecten naar ticket_show (met succesmelding)

     */
    public function save(Request $request, $ticket_id){
//        dd($request);
        $ticket = Ticket::findOrFail($ticket_id);

        $this->authorize('comment', $ticket);

        //jeroen vond het goed zo!!
        $request->validate(
            [
                'contents' => 'required'
            ]
            );

        $comment = new Comment();
        $comment->contents = $request->contents;
        $comment->ticket()->associate($ticket);
        $request->user()->comments()->save($comment);


        return redirect()
            ->route('ticket_show', ['id' => $ticket, '#comments'])
            ->with('succes', 'comment is succesvol verzonden!');

    }
}
