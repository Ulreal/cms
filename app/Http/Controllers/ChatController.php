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
    public function __construct()
    {
       /* if (!Auth::user()->can('chat')) {
            Flash::error("Vous n'avez pas la permission !");
            Redirect::route('index');
        }
       */
    }

    public function index() {

        //suppression
        $date = new \DateTime();
        $date->modify('-60 minutes');
        Chat::where('created_at', '<=', $date->format('Y-m-d H:i:s'))->delete();

        $chats = Chat::all(); // 'SELECT * FROM Chat' => fetchAll

        return view('chat.index', compact(['chats']));
    }

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

        return Redirect::route('chat.index');
    }
}
