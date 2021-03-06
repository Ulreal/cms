@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Forum</h1></div>
        <div class="panel-body">
            <div class="post">
                <table class="table">
                    <thead>
                        {!! $posts->links() !!}

                        <tr>
                            <th>Titre du post</th>
                            <th>Créé par</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td style="max-width: 250px;word-wrap: break-word;word-break: normal;">{{ link_to_route('post.show', $post->title, ['id' => $post->id]) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                @if (Auth::user()->id === $post->userid || Entrust::hasRole('admin'))
                                    {{ link_to_route('post.edit', '', ['id' => $post->id], ['title' => 'Éditer le post', 'style' => 'float: left;padding: 2px;margin-right: 10px;text-decoration: none;', 'class' => 'glyphicon glyphicon-pencil']) }}
                                    {{ Form::model($post, ['route' => ['post.destroy', $post->id], 'method' => 'DELETE']) }}
                                    <button title="Supprimer le post" class="btn btn-link" style='float:left;padding: 0px;' type="submit"><i class="glyphicon glyphicon-trash"></i></button>
                                    {{ Form::close() }}
                                @else
                                    <i style="color:silver;">Aucune</i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tbody/>


                </table>
                {{ link_to_route('post.create', 'Ajouter un post', [], ['class' => 'addPostButton btn btn-primary']) }}

            </div>
        </div>
    </div>
    <style>
    .pagination {
        margin:0px!important;
    }
    @media screen and (max-width: 400px) and (min-width: 300px) {
        .panel-body {
            padding: 0;
        }
        .pagination {
            margin:5px!important;
        }
        .addPostButton {
            margin: 10px auto!important;
            display: block;
            width: 70%;
            float:none!important;
        }
    }
    </style>
@endsection
