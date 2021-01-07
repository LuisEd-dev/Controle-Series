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

    <a href="/series/criar" class="btn btn-dark mb-3">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
        <li class="list-group-item">{{ $serie->nome }}</li>
        @endforeach
    </ul>
</div>
@endsection
