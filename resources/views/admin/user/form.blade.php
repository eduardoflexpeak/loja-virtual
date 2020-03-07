@extends('adminlte::page')

@section('title', 'Formulário de Usuário')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulário de Usuário</h3>
        </div>
        <div class="card-body">

            @if (isset($user))
                {!! Form::model($user, ['url' => route('admin.user.update', $user), 'method' => 'put']) !!}
            @else
                {!! Form::open(['url' => route('admin.user.store')]) !!}
            @endif
                <div class="form-group">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Senha') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
