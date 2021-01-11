<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Collection};

class Temporada extends Model
{

    protected $fillable = ['numero'];
    public $timestamps = false;

    public function episodios(){
        return $this->hasMany(Episodio::class);
    }

    public function serie(){
        return $this->belongsTo(Serie::class);
    }

    public function getEpisodiosAssistidos() : Collection
    {
        return $this->episodios->filter(function (Episodio $episodio){
            return $episodio->assistido;
        });
    }
}
