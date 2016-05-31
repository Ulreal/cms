@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">La page n'existe pas</div>

        <div class="panel-body">
            Code: {{$code}}
        </div>
        {{ link_to('home', "Home", ['class' => 'btn btn-primary']) }}
    </div>
@endsection
