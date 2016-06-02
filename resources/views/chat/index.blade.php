@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')

    <h1>Bienvenu sur le Chat!</h1>

    <div class="panel panel-primary" id="chat">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-comment"></span> Chat
        </div>
        <div class="panel-body">
            <ul class="chat">
                @foreach($chats as $key => $chat)
                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($chat->user->email))) }}?s=50" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">{{$chat->user->name}}</strong>
                            <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time"></span> {{$chat->created_at->diffForHumans()}}
                            </small>
                        </div>
                        <p>{{$chat->message}}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="panel-footer">
            {{ Form::open(['route' => 'chat.add']) }} {{--Class foram, méthode open et requette 'oute' et lien 'chat.add'--}}
            <div class="input-group">
                {{ Form::text('message', '', ['required' => '', 'class' => 'form-control input-sm', 'placeholder' => 'Type your message here...']) }}
                <span class="input-group-btn">
                    {{ Form::submit('Send', ['class' => 'btn btn-warning btn-sm']) }}
                </span>
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection
