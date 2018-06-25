@extends('layout.principal')

@section('conteudo')
<div class="card col-6 mx-auto mt-4">
    <h5 class="card-title mt-4 ml-4">Bem vindo, faça seu login!</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Digite seu e-mail" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mt-2" name="password" placeholder="Digite sua senha" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <button type="submit" class="btn btn-primary mt-2">
                {{ __('Entrar') }}
            </button>
        </form>
    </div>
</div>
@endsection
