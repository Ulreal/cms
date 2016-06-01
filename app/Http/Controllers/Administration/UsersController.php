<?php

namespace App\Http\Controllers\Administration;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('administration.users.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('administration.users.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $roleadmin = Role::findOrFail(1);
        $rolechat = Role::findOrFail(2);
        $roleforum = Role::findOrFail(3);
        $rolenews = Role::findOrFail(4);
        if ($request->input('admin')) {
            if (!$user->hasRole('admin'))
                $user->attachRole($roleadmin);
        } else {
            if ($user->hasRole('admin'))
                $user->detachRole($roleadmin);
        }

        if ($request->input('chat')) {
            if (!$user->hasRole('chat'))
                $user->attachRole($rolechat);
        } else {
            if ($user->hasRole('chat'))
                $user->detachRole($rolechat);
        }

        if ($request->input('forum')) {
            if (!$user->hasRole('forum'))
                $user->attachRole($roleforum);
        } else {
            if ($user->hasRole('forum'))
                $user->detachRole($roleforum);
        }

        if ($request->input('news')) {
            if (!$user->hasRole('news'))
                $user->attachRole($rolenews);
        } else {
            if ($user->hasRole('news'))
                $user->detachRole($rolenews);
        }

        $user->save();
        Flash::success('Utilisateur bien modifiée!');
        return Redirect::route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Redirect::route('admin.users.index');
    }
}
