@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')

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
                {{ Form::open(['route' => 'chat.add']) }} {{--Class foram, méthode open et requette 'oute' et lien 'chat.add'--}}
                {{ Form::label('message', 'Mon message') }}
                {{ Form::text('message', '', ['class' => 'form-control']) }}
                <hr>
                {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
