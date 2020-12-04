@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="card mb-3">
            @if(session('succes'))
                <div class="alert alert-success">
                    {{ session('succes') }}
                </div>
            @endif

            <div class="card-body">
                <h5 class="card-title">{{$ticket->title}}</h5>
                <em>{{$ticket->created_at->toFormattedDateString() }}</em>
                <h6> {{$ticket->submitting_user->name}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">{{$ticket->status->description}}</h6>
                <a href="{{ \App\Http\Controllers\TicketController::claim($ticket->id)}}" class="href">claim ticket</a>
                <p class="card-text">{!! nl2br(e($ticket->description)) !!}</p>
                <h6 class="card_title">

                @forelse($ticket->comments as $comment)
                    <div class="card-footer">
                        <p>comment:</p>
                        <p>{{$comment->created_at}}</p>
                        <p>{{$comment->contents}}</p>
                        <p>{{$comment->user->name}}</p>
                    </div>
                    @empty
                    <p>deze ticket heeft geen comment...</p>
                @endforelse
            </div>


            @can('comment', $ticket)
            <div class="card-footer">
                <form id="form" method="POST" action="{{ route('comment_save', ['id' => $ticket])}}">
                    @csrf
                    <div class="form-group row">
                        <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                        <div class="col-md-6">
                            <textarea id="contents" name="contents" class="form-control @error('contents') is-invalid @enderror">{{old('contents')}}</textarea>

                            @error('contents')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Comment') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endcan
        </div>
    </div>
@endsection