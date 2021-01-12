@extends('layout')

@section('cabecalho')
Episodios da Temporada {{ $temporada->numero }}
@endsection

@section('conteudo')

<form action="/temporadas/{{ $temporada->id }}/episodios/assistir" method="POST">
    @csrf
    <ul class="list-group">
        @foreach ($temporada->episodios as $episodio)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Episodio {{ $episodio->numero }}
                <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}"
                {{ ($episodio->assistido) ? 'checked' : '' }}>
            </li>
        @endforeach
    </ul>

    @auth
        <button type="submit" class="btn btn-primary mt-2 mb-2">
            Salvar
        </button>
    @endauth

</form>
@endsection
