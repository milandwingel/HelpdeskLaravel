@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-body">
            <div class="card mb-3">
                <div class="card-header">
                    {{__('Not Allowed')}}
                </div>

                <div class="card-body">
                    {{__('The contents of the page you requested, is not mean to you...')}}
                </div>
            </div>
        </div>
    </div>
@endsection