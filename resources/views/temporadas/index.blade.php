@extends('layout')

@section('cabecalho')
Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')

    <div class="row">
        <div class="col col-12 text-center mb-3">
            <a href="/storage/{{ ($serie->capa == null) ? 'capas/sem_imagem.png' : $serie->capa }}">
                <img src="/storage/{{ ($serie->capa == null) ? 'capas/sem_imagem.png' : $serie->capa }}" class="img-thumbnail" height="400px" width="400px">
            </a>
        </div>

    </div>

    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/temporadas/{{ $temporada->id }}/episodios">Temporada {{ $temporada->numero }}</a>
                <span class="badge badge-secondary">
                    {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
                </span>
            </li>
        @endforeach
    </ul>

@endsection
