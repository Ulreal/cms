<?php

namespace App\Http\Controllers;

use Auth;
use App\Chat;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;


class ChatController extends Controller
{
    public function index() {

        //Modèle MVC = ici on est dans la partie Controllers
        //Page accueil du chat

        //Calcul de la durée d'expiration
        $date = new \DateTime();
        $date->modify('-60 minutes');

        //Supprimer les chats qui ont dépassés la durée de vie
        Chat::where('created_at', '<=', $date->format('Y-m-d H:i:s'))->delete();

        //Afficher les autres chats
        $chats = Chat::all(); // 'SELECT * FROM Chat' => fetchAll
        return view('chat.index', compact(['chats']));
    }

    //Création d'un chat
    public function create(Request $request) {

        if (!empty($request->input('message'))) {
            // sauvegarde l'enregistrement
            $chat = new Chat();
            $chat->message = $request->input('message');
            $chat->userid = Auth::user()->id;
            $chat->save();

            Flash::success('Message bien ajouté !');
        } else {
            Flash::error('Veuillez saisir un message !');
        }

        //Retour à la page d'accueil du chat
        return Redirect::route('chat.index');
    }
}
