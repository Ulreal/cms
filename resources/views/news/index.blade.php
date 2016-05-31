@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron">Bienvenu sur les News!</div>

                @foreach($news as $new)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{link_to_route('news.show', $new->titre, [$new->id])}}
                    </div>
                    <div class="panel-body">
                        {{Str::limit($new->contenu, 100, ' ...')}}
                    </div>
                    <div class="panel-footer">{{date('d-m-Y H:i:s', strtotime($new->created_at))}}</div>
                </div>
                @endforeach


                {!! $news->links() !!}
            </div>
        </div>
    </div>
@endsection