@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenue</div>
                    <div class="panel-body">
                        Voici le Forum
                        <div class="post">
                            <table class="table">
                                <tr>
                                    <th>Titre du post</th>
                                    <th>Créé par</th>
                                    <th>Date de création</th>
                                </tr>
                                <tr>
                                    @foreach($posts as $post)
                                        <td><a href="/{{$post->id}}/view">{{$post->title}}</a></td>
                                        <td>{{$post->userid}}</td>
                                        <td>{{$post->created_at}}</td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
