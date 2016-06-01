@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')

    <h1>Administration des news!</h1>
    <div class="panel panel-default">
        <div class="panel-heading">News</div>
        <div class="panel-body">
            {!! $grid !!}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Création d'une nouvelle news</div>
        <div class="panel-body">
            {{ Form::open(['route' => ['admin.news.create']]) }}
            <div class="form-group">
                {{ Form::label('titre', 'Titre') }}
                {{ Form::text('titre', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('contenu', 'Le contenu') }}
                {{ Form::textarea('contenu', null, ['class' => 'form-control']) }}
            </div>
            {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
