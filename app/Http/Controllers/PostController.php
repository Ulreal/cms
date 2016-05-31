<?php

namespace App\Http\Controllers;

use Auth, Validator, Input, Redirect, HTML, DB;
use App\Post;
use App\Comment;
use App\Http\Requests;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;


class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return view('post.index')->with('posts', $posts);
    }

    public function store(Request $request) {
        $rules = array(
            'title'   => 'required|min:4|max:255',
            'content' => 'required|min:15|max:500',
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            Flash::error('Les champs ne sont pas correctement remplis.');
            return Redirect::route('post.create')->withErrors($validator);
        }else{
            // sauvegarde l'enregistrement
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->userid = Auth::user()->id;
            $post->save();

            Flash::success('Post bien ajouté.');
        }

        return Redirect::route('post.index');
    }

    public function create(Request $request) {
        return view('post.create');
    }

    public function show($id) {
        $post = Post::findOrFail($id);
        return view('post.show')->with('post', $post);
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        return view('post.edit')->with('post', $post);

    }

    public function update(Request $request, $id) {

        $rules = array(
            'title'   => 'required|min:4|max:255',
            'content' => 'required|min:15|max:500',
        );

        // $messages = [
        //     'title.required' => 'Vous devez mettre un titre.',
        //     'title.between' => 'Votre :attribute doit faire entre :min et :max caractères',
        //     'title.min' => 'Votre :attribute doit faire au minimum :min caractères',
        //     'content.required' => 'Vous devez mettre un :attribute',
        //     'content.between' => 'Votre :attribute doit faire entre :min et :max caractères',
        //     'content.min' => 'Votre :attribute doit faire au minimum :min caractères',
        // ];

    $validator = Validator::make(Input::all(), $rules /*$messages*/);

    // process the login
    if ($validator->fails()) {
        Flash::error('Les champs ne sont pas correctement remplis.');
        return Redirect::route('post.edit', $id)
                        ->withErrors($validator);
    } else {
        // sauvegarde l'enregistrement
        $post = Post::findOrFail($id);
        $post->title = Input::get('title');
        $post->content = Input::get('content');
        $post->userid = Auth::user()->id;
        $post->save();
        Flash::success('Post bien modifié.');
    }
    return Redirect::route('post.index');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        // redirect
        Flash::success('Le post a bien été supprimé.');
        return Redirect::route('post.index');
    }
}
