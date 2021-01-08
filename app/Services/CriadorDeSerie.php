<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Http\Request;

class CriadorDeSerie{

    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $ep_temporada){
        $serie = Serie::create([ 'nome' => $nomeSerie ]);
        $qtdTemporadas = $qtdTemporadas;
        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for($x = 1; $x <= $ep_temporada; $x++){
                $temporada->episodios()->create(['numero' => $x]);
            }

        }
        return $serie;
    }
}


?>
