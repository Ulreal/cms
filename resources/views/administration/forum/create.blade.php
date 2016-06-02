@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Administration du Forum</h1></div>
        <div class="panel-body">
            Créez votre post
            <div class="send">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        {{ HTML::ul($errors->all()) }}
                    </div>
                @endif

                {{ Form::open(['route' => 'admin.forum.store']) }}

                {{ Form::label('Titre', 'Titre du post') }}
                {{ Form::text('title', '', ['class' => 'form-control', 'minlength'=> '5', 'maxlength' => '155' ]) }}

                {{ Form::label('Contenu', 'Contenu du post') }}
                {{ Form::textarea('content', '', ['class' => 'form-control', 'minlength'=> '15', 'maxlength' => '1500' ]) }}

                {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
