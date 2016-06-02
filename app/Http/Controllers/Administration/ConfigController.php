<?php

namespace App\Http\Controllers\Administration;

use App\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Zofe\Rapyd\Facades\DataGrid;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = DataGrid::source(new Config);

        $grid->add('id','ID', true)->style("width:100px");
        $grid->add('key','Key');
        $grid->add('value','Value');



        $grid->edit(url('/admin/config/edit'), 'Edit','modify');
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

        return  view('administration.config.index', compact('grid'));
    }

    /**
     * Save the new configuration
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'key' => 'required',
            'value' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            Flash::error('Les champs ne sont pas correctement remplis.');
            return Redirect::route('admin.config.index')
                ->withErrors($validator);
        }else{
            // sauvegarde l'enregistrement
            $config = new Config();
            $config->key = $request->input('key');
            $config->value = $request->input('value');
            $config->save();

            Flash::success('Configuration bien ajoutée.');
        }

        return Redirect::route('admin.config.index');
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
            $config = Config::findOrFail($_GET['modify']);
            return view('administration.config.modify', compact(['config'])) ;
        } else if (isset($_GET['delete'])) {
            Config::destroy($_GET['delete']);
            return Redirect::route('admin.config.index');
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
        $config = Config::findOrFail($id);
        //$config->key = $request->input('key');
        $config->value = $request->input('value');
        $config->save();
        Flash::success('Configuration bien modifiée!');
        return Redirect::route('admin.config.index');
    }

}
