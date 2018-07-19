@extends('layout.principal')

@section('conteudo')
<div class="row">
<div class="card col-sm mt-4">
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

<div class="card col-sm mt-4 ml-2">
    <div class="card-body">
        <h5 class="card-title">Gerencie as horas com facilidade</h5>
        <h6 class="card-subtitle mb-2 text-muted">Organize as horas de sua empresa com um sistema online e abandone as planilhas!</h6>

        <p class="card-text">Faça seu cadastro gratuito:</p>
        <form method="POST" action="/account/cadastrar">
            @csrf

            <input type="text" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }} mt-2" name="user" placeholder="Digite o seu nome" required>
            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} mt-2" name="name" placeholder="Empresa" required>
            
            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} mt-2" name="email" placeholder="Seu melhor e-mail" required>

            @if ($errors->has('cEmail'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('cEmail') }}</strong>
                </span>
            @endif

            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} mt-2" name="password" placeholder="Digite sua senha" required>

            @if ($errors->has('cPassword'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('cPassword') }}</strong>
                </span>
            @endif

            <button type="submit" class="btn btn-primary mt-2">
                Cadastrar
            </button>
        </form>
    </div>
</div>
</div>
@endsection
