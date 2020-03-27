@extends('layouts.master')

@section('conteudo')
    <div class="row mt-2">
        @foreach ($produtos as $p)
            <div class="col-md-3">
                <div class="card mt-2">
                    <a href="{{ route('publico.produto.detalhes', $p->id) }}">
                        <img src="{{ asset('/imagens/' . $p->imagem) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $p->nome }}</h5>
                        <h5 class="text-danger">R$ {{ number_format($p->preco, 2, ',', '.') }}</h5>

                        {!! Form::open(['url' => route('publico.carrinho.store')]) !!}
                            {!! Form::hidden('produto', $p->id) !!}
                            {!! Form::number('quantidade', 1, ['class' => 'form-control text-center mb-1']) !!}
                            {!! Form::submit('Adicionar ao Carrinho', ['class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            {{ $produtos->links() }}
        </div>
    </div>
@endsection
