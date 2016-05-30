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

        //suppression
        $date = new \DateTime();
        $date->modify('-60 minutes');
        Post::where('created_at', '<=', $date->format('Y-m-d H:i:s'))->delete();

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
        }

        return Redirect::route('post.index');
    }

    public function createForm(Request $request) {
		return view('post.createForm');
    }
}
