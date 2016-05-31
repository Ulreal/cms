<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class NewsController extends Controller
{
    //Modèle MVC = ici on est dans la partie Controllers
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(2); // 'SELECT * FROM News' => fetchAll
        return view('news.index', compact(['news'])); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->input('titre')) && !empty($request->input('contenu'))) {
            // sauvegarde l'enregistrement
            $new = new News();
            $new->titre = $request->input('titre');
            $new->contenu = $request->input('contenu');
            $new->userid = Auth::user()->id; //récupération en auto (via la class 'Auth', méthode 'user') de l'auteur de la news
            $new->save();

            Flash::success('News bien ajoutée !');
        } else {
            Flash::error('Veuillez saisir un titre & contenu !');
        }

        //Retour à la page d'accueil de la News
        return Redirect::route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = News::findOrFail($id); //Récupère en auto (via la class 'News', méthode 'findOrFail') le chat $id
        return view('news.show', compact(['new']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
