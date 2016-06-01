@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')

    <h1>Edition de la news !</h1>
    <div class="panel panel-default">
        <div class="panel-heading">News</div>
        <div class="panel-body">
            {{ Form::model($news, ['route' => ['admin.news.update', $news->id]]) }}
            <div class="form-group">
                {{ Form::label('titre', 'Titre') }}
                {{ Form::text('titre', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('contenu', 'Le contenu') }}
                {{ Form::textarea('contenu', null, ['class' => 'form-control']) }}
            </div>
            {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
            {{link_to_route('admin.news.index', 'Précédent', [], ["class" => 'btn btn-default'])}}

            {{ Form::close() }}
        </div>
    </div>

@endsection
