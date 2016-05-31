<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;


class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return view('post.index', compact(['posts']));
    }

    public function create(Request $request) {

        if (!empty($request->input('content')) && !empty($request->input('title'))) {
            // sauvegarde l'enregistrement
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->userid = Auth::user()->id;
            $post->save();

            Flash::success('Post bien ajouté.');
        } else {
            Flash::error('Veuillez remplir tous les champs.');
            return view('post.create');
        }

        return Redirect::route('post.index');
    }

    public function createForm(Request $request) {
		return view('post.create');
    }

    public function show(Request $request, $id) {

    }

    public function edit(Request $request) {
    }

    public function delete(Request $request) {

    }
}
