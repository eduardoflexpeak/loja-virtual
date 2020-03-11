@extends('adminlte::page')

@section('title', 'Formulário de Produto')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulário de Produto</h3>
        </div>
        <div class="card-body">

            @if (isset($produto))
                {!! Form::model($produto, ['url' => route('admin.produto.update', $produto), 'method' => 'put', 'files' => 'true']) !!}
            @else
                {!! Form::open(['url' => route('admin.produto.store'), 'files' => 'true']) !!}
            @endif
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
                    @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('descricao', 'Descrição') !!}
                    {!! Form::textArea('descricao', null, ['class' => 'form-control', 'rows' => 4, 'required']) !!}
                    @error('descricao') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('preco', 'Preço') !!}
                    {!! Form::text('preco', null, ['class' => 'form-control', 'required']) !!}
                    @error('preco') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('estoque', 'Estoque') !!}
                    {!! Form::number('estoque', null, ['class' => 'form-control', 'required']) !!}
                    @error('estoque') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('imagem_temp', 'Imagem') !!}
                    {!! Form::file('imagem_temp', ['class' => 'form-control', $produto ?? 'required']) !!}
                    @error('imagem_temp') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Categorias</label>
                    <select class="form-control" name="categorias[]" id="select-categorias"></select>
                </div>
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        var catSelecionadas = [];

        @isset($produto)
            @foreach($produto->categorias as $cat)
                var c = {
                    id:         {{ $cat->id }},
                    text:       '{{ $cat->nome }}',
                    selected:   true
                }
                catSelecionadas.push(c);
            @endforeach
        @endisset

        $('#select-categorias').select2({
            placeholder: 'Lista de categorias',
            multiple: true,
            data: catSelecionadas,
            ajax: {
                url: '{{ route('admin.lista.categorias') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
            }
        });
    </script>
@stop
