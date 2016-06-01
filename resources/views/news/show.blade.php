@extends('layouts.app')

@section('content')

    {{link_to_route('news.index', 'Précédent', [], ["class" => 'btn btn-primary'])}}

    <div class="panel panel-default">
        <div class="panel-heading">{{$new->titre}}</div>
        <div class="panel-body">
            {{$new->contenu}}
        </div>
        <div class="panel-footer">
            {{date('d-m-Y H:i:s', strtotime($new->created_at))}}
        </div>
    </div>
@endsection