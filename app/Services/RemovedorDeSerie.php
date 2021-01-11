<?php
namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie{

    public function removerSerie(Request $request) : string {
        $serie = Serie::find($request->id);
        DB::transaction(function () use (&$serie) {

            $this->removerTemporadas($serie);

            $serie->delete();

        });
        return $serie->nome;
    }

    private function removerTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada){
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada){
        $temporada->episodios()->each(function (Episodio $episodio){
            $episodio->delete();
        });
    }

}
