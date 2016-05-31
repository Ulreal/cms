@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
            </div>
        </div>
    </div>
@endsection