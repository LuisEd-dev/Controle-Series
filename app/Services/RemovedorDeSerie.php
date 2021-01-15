<?php
namespace App\Services;

use App\Mail\SerieRemovida;
use App\Models\{Serie, Temporada, Episodio, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Mail, Storage};

class RemovedorDeSerie{

    public function removerSerie(Request $request) : string {
        $serie = Serie::find($request->id);
        $autor = $request->user();
        DB::transaction(function () use (&$serie, $autor) {

            $this->removerTemporadas($serie);
            $serie->delete();

            if($serie->capa){
                Storage::delete($serie->capa);
            }

            $to = [];
            foreach(User::all() as $user){
                $email = new SerieRemovida($serie->nome, $autor->name);
                $email->subject = $autor->name . ' removeu uma série';

                array_push($to, ['email' => $user->email,
                'name' => $user->name]);
            }
            Mail::to($to)->send($email);
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
