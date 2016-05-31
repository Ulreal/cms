@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Bienvenu sur le Chat!</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>
                    <div class="panel-body">
                        <div class="chat">
                            <ul>
                                @foreach($chats as $chat)
                                <li>{{$chat->message}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="send">
                            {{ Form::open(['route' => 'chat.add']) }}
                            {{ Form::label('message', 'Mon message') }}
                            {{ Form::text('message', '', ['class' => 'form-control']) }}
                            <hr>
                            {{ Form::submit('submit!', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection