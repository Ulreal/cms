<div class="panel panel-default">
	<div class="panel-heading">Commentaires</div>
	<div class="panel-body">

		@if (isset($post->comment))
			@foreach($post->comment as $key => $comment)
				<div class="top-comment-content" style="min-height: 30px;">
					<p style="float:left;">Par <i>{{ $comment->user->name }}</i> le <i>{{ $comment->created_at }}</i></p>
					@if (Entrust::hasRole('admin'))
						{{ Form::model($post, ['route' => ['comment.destroy', $comment->id], 'method' => 'DELETE', 'style' => 'float: left; padding-left: 10px;']) }}
						<button title="Supprimer le commentaire" class="btn btn-link" style='padding: 0px;' type="submit"><i class="glyphicon glyphicon-trash"></i></button>
						{{ Form::close() }}
					@endif
				</div>
				<div style="background-color: whitesmoke; padding: 10px; border: 1px solid rgba(0, 0, 0, 0.15); border-radius: 3px; margin: 0px 10px 10px;">
					<p style="word-wrap: break-word;">{{ $comment->content }}</p>
				</div>
			@endforeach

		@else
			<p>Aucun commentaire pour l'instant.</p>
		@endif

		@include('comments.create')
	</div>
</div>
