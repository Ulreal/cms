@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Forum</h1></div>
        <div class="panel-body">
            Créez votre post
            <div class="send">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        {{ HTML::ul($errors->all()) }}
                    </div>
                @endif

                {{ Form::open(['route' => 'post.store']) }}
                {{ Form::label('Titre', 'Titre du post') }}
                {{ Form::text('title', '', ['required' => '', 'minlength'=> '5', 'maxlength' => '155', 'class' => 'form-control']) }}
                {{ Form::label('Contenu', 'Contenu du post') }}
                {{ Form::textarea('content', '', ['required' => '', 'minlength'=> '15', 'maxlength' => '1500','class' => 'form-control']) }}
                {{ Form::submit('Envoyer', ['style' => 'margin-top:10px;', 'class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
