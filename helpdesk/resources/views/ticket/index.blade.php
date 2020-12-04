@extends('layouts.app')
@section('content')
<div class="container">
    @if(session('succes'))
        <div class="alert alert-success">
            {{ session('succes') }}
        </div>
    @endif

    <div class="card-body">
        @forelse($tickets as $ticket)
            <div class="card mb-3">
                <div class="card-header">
                    {{$ticket->submitting_user->name}}
                    <em>{{$ticket->created_at->toFormattedDateString()  }}</em>
                </div>
                <div class="card-body">
                    <h5 class="card_title">
                        <a href="{{ route('ticket_show', ['id' => $ticket]) }}">
                            {{ $ticket->title }}
                        </a>
                    </h5>
                    <p class="card-text">
                        {!!  nl2br(e($ticket->description)) !!}
                    </p>
                </div>
                <div class="card-footer">
                    {{ $ticket->status->description }}
                </div>
            </div>
         @empty
            {{ __('No tickets availeble...') }}
         @endforelse

    </div>
</div>
@endsection