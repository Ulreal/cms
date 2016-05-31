<h3>Ajouter un commentaire</h3>
@if (count($errors) > 0)
	<div class="alert alert-danger">
		{{ HTML::ul($errors->all()) }}
	</div>
@endif
{{ Form::open(['route' => 'comment.store']) }}
{{ Form::label('content', 'Votre commentaire') }}
{{ Form::textarea('content', '', ['class' => 'form-control']) }}
{{ Form::hidden('postid', $post->id) }}
{{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
{{-- TODO :: Input hidden avec postId --}}
