@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            @if (Auth::guest())
                Welcome
            @else
                You are logged in!
            @endif
        </div>
    </div>

@endsection
