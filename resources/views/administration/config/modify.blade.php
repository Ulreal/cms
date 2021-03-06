@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')

    <h1>Edition de la configuration !</h1>
    <div class="panel panel-default">
        <div class="panel-heading">Configuration</div>
        <div class="panel-body">
            {{ Form::model($config, ['route' => ['admin.config.update', $config->id]]) }}
            <div class="form-group">
                {{ Form::label('key', 'Key') }}
                {{ Form::text('key', null, ['class' => 'form-control', 'disabled']) }}
            </div>
            <div class="form-group">
                {{ Form::label('value', 'La valeur') }}
                {{ Form::text('value', null, ['class' => 'form-control']) }}
            </div>
            {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
            {{link_to_route('admin.config.index', 'Précédent', [], ["class" => 'btn btn-default'])}}

            {{ Form::close() }}

        </div>
    </div>

@endsection
