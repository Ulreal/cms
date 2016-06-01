<?php

namespace App\Http\Controllers\Administration;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class ForumController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('administration.forum.index', compact(['posts']));
    }

    public function store(Request $request) {
        $rules = [
            'title'       => 'required|min:4|max:255',
            'content'      => 'required|min:15|max:500',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            Flash::error('Les champs ne sont pas correctement remplis.');
            return Redirect::route('admin.forum.create')
                ->withErrors($validator);
        }else{
            // sauvegarde l'enregistrement
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->userid = Auth::user()->id;
            $post->save();

            Flash::success('Post bien ajouté.');
        }

        return Redirect::route('admin.forum.index');
    }

    public function create(Request $request) {
        return view('administration.forum.create');
    }

    public function show($id) {
        // get the nerd
        $post = Post::findOrFail($id);

        // show the view and pass the nerd to it
        return view('administration.forum.show', compact(['post']));
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        return view('administration.forum.edit', compact(['post']));

    }

    public function update(Request $request, $id) {
        $rules = [
            'title'       => 'required|min:4|max:255',
            'content'      => 'required|min:15|max:500',
        ];

        // $messages = [
        //     'title.required' => 'Vous devez mettre un titre.',
        //     'title.between' => 'Votre :attribute doit faire entre :min et :max caractères',
        //     'title.min' => 'Votre :attribute doit faire au minimum :min caractères',
        //     'content.required' => 'Vous devez mettre un :attribute',
        //     'content.between' => 'Votre :attribute doit faire entre :min et :max caractères',
        //     'content.min' => 'Votre :attribute doit faire au minimum :min caractères',
        // ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            Flash::error('Les champs ne sont pas correctement remplis.');
            return Redirect::route('admin.forum.edit', $id)
                ->withErrors($validator);
        } else {
            // sauvegarde l'enregistrement
            $post = Post::findOrFail($id);
            $post->title = Input::get('title');
            $post->content = Input::get('content');
            $post->save();
            Flash::success('Post bien modifié.');
        }
        return Redirect::route('admin.forum.index');
    }

    public function destroy($id) {
        Post::destroy($id);

        // redirect
        Flash::success('Le post a bien été supprimé.');
        return Redirect::route('admin.forum.index');
    }
}
