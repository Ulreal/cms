@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenue</div>
                    <div class="panel-body">
                        Créez votre post
                        <div class="send">
                            {{ Form::open(['route' => 'post.add']) }}
                            {{ Form::label('Titre', 'Titre du post') }}
                            {{ Form::text('title', '', ['class' => 'form-control']) }}
                            {{ Form::label('Contenu', 'Contenu du post') }}
                            {{ Form::textarea('content', '', ['class' => 'form-control']) }}
                            {{ Form::submit('submit!', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
