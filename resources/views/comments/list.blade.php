<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Commentaires</div>
				<div class="panel-body">

					{{-- @if (Auth::user()->id === $post->userid)
						{{ link_to_route('post.edit', '', ['id' => $post->id], ['style' => 'float: left;padding: 2px;margin-right: 10px;text-decoration: none;', 'class' => 'glyphicon glyphicon-pencil']) }}
						{{ Form::model($post, ['route' => ['post.destroy', $post->id], 'method' => 'DELETE']) }}
						<button class="btn btn-link" style='float:left;float: left;padding: 0px;' type="submit"><i class="glyphicon glyphicon-trash"></i></button>
						{{ Form::close() }}
					@else
						<i style="color:silver;">Aucune</i>
					@endif --}}
					@if (isset($post->comment))
						@foreach($post->comment as $key => $comment)
							<p>Par <i>{{ $comment->user->name }}</i> le <i>{{ $comment->created_at }}</i></p>

							<div style="background-color: whitesmoke; padding: 10px; border: 1px solid rgba(0, 0, 0, 0.15); border-radius: 3px; margin: 0px 10px 10px;">
								<p>{{ $comment->content }}</p>
							</div>
						@endforeach

					@else
						<p>Aucun commentaire pour l'instant.</p>
					@endif

					@include('comments.create')
				</div>
			</div>
		</div>
	</div>
</div>
