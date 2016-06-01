@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Administration des utilisateurs</h1></div>
        <div class="panel-body">
            Modifier l'utilisateur
            <div class="send">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
                </div>
                @endif

                {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) }}
                <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>

                @foreach($roles as $role)
                        <div class="checkbox">
                            <label>
                                <?php
                                $hasRole = false;
                                foreach($user->roles as $row):
                                        if($row->name == $role->name):
                                            $hasRole = true;
                                        endif;
                                endforeach;
                                ?>
                                {{Form::checkbox($role->name, $role->name,  $hasRole)}} {{$role->display_name}}
                            </label>
                        </div>
                @endforeach

                {{ Form::submit('Envoyer', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
