@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


        <div class="col-md-3">
            @if ($Config['menu_gauche'] == 'true')
            <div class="sidebar-module">
                <h4>Partner</h4>
                <ol class="list-unstyled">
                    <li><a href="http://google.com">Google</a></li>
                    <li><a href="http://www.instic.fr/">Instic</a></li>
                </ol>
            </div>
            @endif
        </div>


        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>

        <div class="col-md-3">
            @if ($Config['menu_droite'] == 'true')
            <div class="sidebar-module">
                <h4>Social Network</h4>
                <ol class="list-unstyled">
                    <li><a href="http://facebook.com">Facebook</a></li>
                    <li><a href="http://twitter.com">Twitter</a></li>
                </ol>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
