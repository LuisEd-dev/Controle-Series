<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Services\{CriadorDeSerie, RemovedorDeSerie};
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

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie){

        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_temporada);

        $request->session()->flash('mensagem', "Série {$serie->nome} com suas temporadas e episodios adicionada com sucesso.");

        return redirect(route('listar_series'));

    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie){

        $nome = $removedorDeSerie->removerSerie($request);

        $request->session()->flash('mensagem', "Série $nome excluida com sucesso.");

        return redirect(route('listar_series'));

    }

    public function editaNome(Request $request, int $id)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
