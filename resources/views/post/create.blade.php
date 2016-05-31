@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Forum</h1></div>
                    <div class="panel-body">
                        Créez votre post
                        <div class="send">
                            {{ Form::open(['route' => 'post.store']) }}
                            {{ Form::label('Titre', 'Titre du post') }}
                            {{ Form::text('title', '', ['class' => 'form-control']) }}
                            {{ Form::label('Contenu', 'Contenu du post') }}
                            {{ Form::textarea('content', '', ['class' => 'form-control']) }}
                            {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
