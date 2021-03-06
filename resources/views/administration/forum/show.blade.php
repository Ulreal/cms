@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Administration du Forum</div>
		<div class="panel-body">
			<div class="show">
				<h2>{{ $post->title }}</h2>
				<div style="background-color: whitesmoke; padding: 10px; border: 1px solid rgba(0, 0, 0, 0.15); border-radius: 3px; margin: 20px 10px 10px;">
					<p>{{ $post->content }}</p>
				</div>
				<p>Par <i>{{ $post->user->name }}</i> le <i>{{ $post->created_at }}</i></p>
			</div>
		</div>
	</div>
@endsection
