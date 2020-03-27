@extends('layouts.master')

@section('conteudo')
    {{--
        Baseado em:
        https://bootsnipp.com/snippets/y22W
    --}}
    <div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-primary">Produtos no seu carrinho</h4>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary btn-block" href="{{ url('/') }}">
                                Continuar comprando
                            </a>
                        </div>
                    </div>
				</div>
				<div class="card-body">
                    @if (session('carrinho'))
                        @foreach (session('carrinho') as $id => $dados)
                            <div class="row">
                                <div class="col-md-1">
                                    <img class="img-fluid" src="{{ asset('/imagens/' . $dados['imagem']) }}">
                                </div>
                                <div class="col-md-4">
                                    <h4 class="product-name"><strong>{{ $dados['nome'] }}</strong></h4>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6 text-right">
                                            <h6><strong>R$ {{ number_format($dados['preco'], 2, ',', '.') }} <span class="text-muted">x</span></strong></h6>
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::open(['url' => route('publico.carrinho.update', $id), 'method' => 'put']) !!}
                                                {!! Form::number('quantidade', $dados['quantidade'], ['class' => 'form-control input-sm text-center']) !!}
                                        </div>
                                        <div class="col-md-1">
                                                {!! Form::button('<i class="fas fa-sync"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="col-md-1">
                                            {!! Form::open(['url' => route('publico.carrinho.destroy', $id), 'method' => 'delete']) !!}
                                                {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <h4 class="text-center">Seu carrinho está vazio</h4>
                    @endif

				</div>
				<div class="card-footer">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="text-right">Total <strong>R$ {{ number_format(session('total') ?? 0, 2, ',', '.') }}</strong></h4>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success btn-block">
                                Finalizar Compra
                            </button>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection
