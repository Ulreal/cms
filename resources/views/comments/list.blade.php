<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Commentaires</div>
				<div class="panel-body">
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
