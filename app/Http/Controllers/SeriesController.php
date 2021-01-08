<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
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

    public function store(SeriesFormRequest $request){

        $serie = Serie::create([ 'nome' => $request->nome ]);
        $qtdTemporadas = $request->qtd_temporadas;
        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for($x = 1; $x <= $request->ep_temporada; $x++){
                $temporada->episodios()->create(['numero' => $x]);
            }

        }

        $request->session()->flash('mensagem', "Série {$request->nome} com suas temporadas e episodios adicionada com sucesso.");

        return redirect(route('listar_series'));

    }

    public function destroy(Request $request){

        Serie::destroy($request->id);

        $request->session()->flash('mensagem', "Série excluida com sucesso.");

        return redirect(route('listar_series'));

    }
}
