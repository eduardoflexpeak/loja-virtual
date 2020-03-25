@extends('layouts.master')

@section('conteudo')
    <div class="row mt-2">
        <div class="col-md-3 text-center">
            <img src="{{ asset('/imagens/' . $produto->imagem) }}" class="card-img-top mb-2" alt="...">

            {!! Form::open(['url' => route('publico.carrinho.store')]) !!}
                {!! Form::hidden('produto', $produto->id) !!}
                {!! Form::submit('Adicionar ao Carrinho', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-9">
            <h2 class="card-title text-primary">{{ $produto->nome }}</h2>
            <h3 class="text-danger">R$ {{ number_format($produto->preco, 2, ',', '.') }}</h3>

            <h5 class="text-primary mt-3">Descrição</h5>
            <p>lv{{ $produto->descricao }}</p>
        </div>
    </div>
@endsection
