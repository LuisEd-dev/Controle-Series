@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')

    @isset($mensagem)
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
    @endisset

    <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-3">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $serie->nome }}
            <form action="/series/{{ $serie->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                @csrf
                @method("delete")
                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
            </form>

        </li>
        @endforeach
    </ul>
</div>
@endsection
