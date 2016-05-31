@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Forum</h1></div>
        <div class="panel-body">
            <div class="post">
                <table class="table">
                    <tr>
                        <th>Titre du post</th>
                        <th>Créé par</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ link_to_route('post.show', $post->title, ['id' => $post->id], ['class' => '']) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                @if (Auth::user()->id === $post->userid)
                                    {{ link_to_route('post.edit','Éditer', ['id' => $post->id], ['style' => 'float: left; margin-right: 10px;', 'class' => 'btn btn-warning']) }}
                                    {{-- {{ link_to_route('post.destroy','Supprimer', ['id' => $post->id], ['class' => 'btn btn-danger']) }} --}}
                                    {{ Form::model($post, ['route' => ['post.destroy', $post->id], 'method' => 'DELETE']) }}
                                    {{ Form::submit('Supprimer', ['class' => 'btn btn-danger']) }}
                                    {{ Form::close() }}
                                @else
                                    <i style="color:silver;">Aucune</i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ link_to_route('post.create','Ajouter un post', [], ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
@endsection
