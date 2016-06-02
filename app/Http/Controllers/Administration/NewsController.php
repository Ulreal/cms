<?php

namespace App\Http\Controllers\Administration;

use App\News;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Zofe\Rapyd\Facades\DataGrid;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = DataGrid::source(News::with('user'));

        $grid->add('id','ID', true)->style("width:100px");
        $grid->add('titre','Titre');
        $grid->add('{{ substr($contenu,0,20) }}...','Contenu');
        $grid->add('user.name','Creator');

        $grid->edit(url('/admin/news/edit'), 'Edit','modify|delete|show');
        $grid->orderBy('id','asc');
        $grid->paginate(10);

        $grid->row(function ($row) {
            if ($row->cell('id')->value == 20) {
                $row->style("background-color:#CCFF66");
            } elseif ($row->cell('id')->value > 15) {
                $row->cell('title')->style("font-weight:bold");
                $row->style("color:#f00");
            }
        });

        return  view('administration.news.index', compact('grid'));
    }

    /**
     * Save the new configuration
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'titre' => 'required',
            'contenu' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            Flash::error('Les champs ne sont pas correctement remplis.');
            return Redirect::route('admin.news.index')
                ->withErrors($validator);
        }else{
            // sauvegarde l'enregistrement
            $news = new News();
            $news->titre = $request->input('titre');
            $news->contenu = $request->input('contenu');
            $news->userid = Auth::user()->id;
            $news->save();

            Flash::success('News bien ajoutée.');
        }

        return Redirect::route('admin.news.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (isset($_GET['modify'])) {
            $news = News::findOrFail($_GET['modify']);
            return view('administration.news.modify', compact(['news'])) ;
        } else if (isset($_GET['delete'])) {
            News::destroy($_GET['delete']);
            return Redirect::route('admin.news.index');
        } else if (isset($_GET['show'])) {
            return Redirect::route('news.show', [$_GET['show']]);
        }
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
        $news = News::findOrFail($id);
        $news->titre = $request->input('titre');
        $news->contenu = $request->input('contenu');
        $news->save();
        Flash::success('News bien modifiée!');
        return Redirect::route('admin.news.index');
    }
}
