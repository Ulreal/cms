@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">La page n'existe pas</div>

                    <div class="panel-body">
                        Code: {{$code}}
                    </div>
                    {{ link_to('home', "Home", ['class' => 'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
@endsection
