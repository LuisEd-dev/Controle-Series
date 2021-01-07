<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request){
        $series = Serie::query()->orderBy("nome")->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem') );
    }

    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
        Serie::create([ 'nome' => $request->nome ]);

        $request->session()->flash('mensagem', "Série {$request->nome} adicionada com sucesso.");

        return redirect(route('listar_series'));

    }

    public function destroy(Request $request){

        Serie::destroy($request->id);

        $request->session()->flash('mensagem', "Série excluida com sucesso.");

        return redirect(route('listar_series'));

    }
}
