@extends('layouts.app')

//Modèle MVC = ici on est dans la partie Views

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        Bienvenu sur le chat!

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
                            {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
