@extends('layouts.app')

<!-- Modèle MVC = ici on est dans la partie Views -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Page de configuration!</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">Configurations</div>
                    <div class="panel-body">
                        {!! $grid !!}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Création d'une nouvelle configuration</div>
                    <div class="panel-body">
                        {{ Form::open(['route' => ['admin.config.create']]) }}
                        <div class="form-group">
                            {{ Form::label('key', 'Key') }}
                            {{ Form::text('key', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('value', 'La valeur') }}
                            {{ Form::text('value', null, ['class' => 'form-control']) }}
                        </div>
                        {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
