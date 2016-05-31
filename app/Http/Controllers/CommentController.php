<?php

namespace App\Http\Controllers;

use Auth, Validator, Input, Redirect, HTML, DB;
use App\Comment;
use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CommentController extends Controller
{
    public function index() {
        $comments = comment::all();
        return view('comment.index')->with('comments', $comments);
    }

    public function store(Request $request) {
        $rules = array(
            'content' => 'required|min:5|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            // Flash::error('Veuillez mettre un commentaire comprenant entre 5 et 255 caractères');
            return Redirect::route('post.show', $request->input('postid'))->withErrors($validator);
        }else{
            $comment = new Comment();
            $comment->content = $request->input('content');
            $comment->userid = Auth::user()->id;
            $comment->postid = $request->input('postid');
            $comment->save();

            Flash::success('Commentaire bien ajouté.');
        }
        return Redirect::route('post.show', $request->input('postid'));
    }

    public function create(Request $request) {
        return view('comment.create');
    }

    public function show($id) {
        $comment = Comment::findOrFail($id);
        return view('comment.show')->with('comment', $comment);
    }

    public function edit($id) {
        $comment = Comment::findOrFail($id);
        return view('comment.edit')->with('comment', $comment);
    }

    public function update(Request $request, $id) {

        // $rules = array(
        //     'content' => 'required|min:15|max:255',
        // );
        //
        // $validator = Validator::make(Input::all(), $rules);
        //
        // if ($validator->fails()) {
        //     Flash::error('Les champs ne sont pas correctement remplis.');
        //     return Redirect::route('comment.edit', $id)->withErrors($validator);
        // } else {
        //     $comment = Comment::findOrFail($id);
        //     $comment->content = Input::get('content');
        //     $comment->postid = Input::get('postid');
        //     $comment->userid = Auth::user()->id;
        //     $comment->save();
        //     Flash::success('Commentaire bien modifié.');
        // }
        // return Redirect::route('comment.index');
    }

    public function destroy($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        Flash::success('Le comment a bien été supprimé.');
        return Redirect::route('comment.index');
    }
}
