@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
                                        <td style="max-width: 250px;word-wrap: break-word;word-break: normal;">{{ link_to_route('post.show', $post->title, ['id' => $post->id], ['class' => '']) }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            @if (Auth::user()->id === $post->userid)
                                                {{ link_to_route('post.edit', '', ['id' => $post->id], ['style' => 'float: left; margin-right: 10px;text-decoration: none;', 'class' => 'glyphicon glyphicon-pencil']) }}
                                                {{-- Link to submit the hidden form --}}
                                                {{ HTML::link('#', '', array('id' => 'deletePostLink'.$post->id, 'style' => 'text-decoration: none;', 'class' => 'glyphicon glyphicon-trash', 'onClick' => 'submitDeletePost('.$post->id.');'))}}

                                                {{-- Hidden Form --}}
                                                {{ Form::model($post, ['route' => ['post.destroy', $post->id], 'method' => 'DELETE', 'style' => 'display:none;']) }}
                                                {{ Form::submit('', ['class' => 'glyphicon glyphicon-trash']) }}
                                                {{ Form::close() }}
                                            @else
                                                <i style="color:silver;">Aucune</i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{ link_to_route('post.create', 'Ajouter un post', [], ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function submitDeletePost(postId) {
        if(confirm('Voulez-vous vraiment supprimer ce post ?')){
            $('#deletePostLink'+postId).parent().find('form').submit();
        }
    }
    </script>
@endsection
