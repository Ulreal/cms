@extends('layouts.app')

@section('content')
    {{link_to_route('news.index', 'Précédent', [], ["class" => 'btn btn-primary'])}}
    <h1>Ajouter une News!</h1>

    {{ Form::open(['route' => 'news.store']) }}

    {{ Form::label('titre', 'titre de la news') }}
    {{ Form::text('titre', '', ['class' => 'form-control']) }}

    {{ Form::label('contenu', 'saisir votre news') }}
    {{ Form::textarea('contenu', '', ['class' => 'form-control']) }}

    {{ Form::submit('submit!', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection