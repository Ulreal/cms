@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h1 style="font-size:22px; line-height:22px; margin: 0;padding:0;">Administration des utilisateurs</h1></div>
        <div class="panel-body">
            <div class="post">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Date de création</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ link_to_route('post.show', $user->name, ['id' => $user->id]) }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    {{$role->display_name}}
                                    @if ($role !== $user->roles[count($user->roles) - 1]), @endif
                                @endforeach
                            </td>
                            <td>
                                {{ Form::open(['route' => ['admin.users.destroy', $user->id], 'class' => 'pull-right']) }}
                                <button class="btn btn-xs btn-danger" type="submit"><i class="glyphicon glyphicon-trash"></i></button>
                                {{ Form::close() }}

                                {{ Form::open(['route' => ['admin.users.edit',  $user->id], 'class' => 'pull-right']) }}
                                <button class="btn btn-xs btn-warning" type="submit"><i class="glyphicon glyphicon-edit"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ link_to_route('post.create','Ajouter un post', [], ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
@endsection
