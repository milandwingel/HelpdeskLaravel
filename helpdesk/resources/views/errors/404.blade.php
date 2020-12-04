@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-body">
            <div class="card mb-3">
                <div class="card-header">
                    {{__('Not Allowed')}}
                </div>

                <div class="card-body">
                    {{__('Pagina niet gevonden!')}}<br>
                    <a href="{{ route('ticket_index')}}">terug naar home...</a>
                    {{--<a href="{{ route('ticket_show', ['id' => $ticket])}}">Lees meer...</a>--}}

                </div>
            </div>
        </div>
    </div>
@endsection