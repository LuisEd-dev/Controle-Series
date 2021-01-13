<?php

namespace App\Services;

use App\Models\{Serie, Temporada};
use Illuminate\Support\Facades\DB;

class CriadorDeSerie{

    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $ep_temporada, ?string $capa) : Serie{
        DB::beginTransaction();
        $serie = Serie::create([ 'nome' => $nomeSerie, 'capa' => $capa ]);
        $this->criarTemporada($serie, $qtdTemporadas, $ep_temporada);
        DB::commit();
        return $serie;
    }

    private function criarTemporada(Serie $serie, int $qtdTemporadas, int $ep_temporada){
        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criarEpisodio($temporada, $ep_temporada);
        }
    }

    private function criarEpisodio(Temporada $temporada, int $ep_temporada){
        for($x = 1; $x <= $ep_temporada; $x++){
            $temporada->episodios()->create(['numero' => $x]);
        }
    }
}

?>
