@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Une erreur c'est produite</div>

        <div class="panel-body">
            Code: {{$code}}
        </div>
        {{ link_to('home', "Home", ['class' => 'btn btn-primary']) }}
    </div>

@endsection
