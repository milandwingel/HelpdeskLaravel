@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('succes'))
            <div class="alert alert-success">
                {{ session('succes') }}
            </div>
        @endif
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="card col-mb-6">
                    @forelse($assigned_tickets as $ticket)
                    assigned tickets
                    <div class="card-header">
                        {{$ticket->submitting_user->name}}
                        <em>{{$ticket->created_at->toFormattedDateString()  }}</em>
                    </div>
                    <div class="card-body">
                        <h5 class="card_title">
                            <a href="{{ route('ticket_show', ['id' => $ticket]) }}">{{ $ticket->title }}</a>
                        </h5>
                        <p class="card-text">
                            {!!  nl2br(e($ticket->description)) !!}
                        </p>
                    </div>
                    <div class="card-footer">
                        {{ $ticket->status->description }}
                    </div>
                        <a href="{{ route('ticket_show', ['id' => $ticket])}}">{{ $ticket->title }}</a>
                    @empty

                        {{ __('No assigned tickets...') }}
                    @endforelse
                </div>

                <div class="card col-mb-6">
                    unasigned tickets
                    @forelse($unassigned_tickets as $unassigned_ticket)
                        assigned tickets
                        <div class="card-header">
                            {{$unassigned_ticket->submitting_user->name}}
                            <em>{{$unassigned_ticket->created_at->toFormattedDateString()  }}</em>
                        </div>
                        <div class="card-body">
                            <h5 class="card_title">
                                <a href="{{ route('ticket_show', ['id' => $unassigned_ticket]) }}">{{ $unassigned_ticket->title }}</a>
                            </h5>
                            <p class="card-text">
                                {!!  nl2br(e($unassigned_ticket->description)) !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            {{ $unassigned_ticket->status->description }}
                        </div>
                        <div>

                        </div>
                    @empty
                        {{ __('No unassigned tickets...') }}
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection