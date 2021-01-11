<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;;

class EpisodiosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Temporada $temporada, Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('episodios.index', compact('temporada', 'mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request){
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos){
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });
        $temporada->push();

        $request->session()->flash('mensagem', 'Episodios marcados como assistidos');

        return redirect()->back();
    }
}
