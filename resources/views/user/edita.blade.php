@extends('layout.principal')

@section('conteudo')

	<div class="card col-auto mx-auto mt-5">
		<div class="card-body">
			<h5 class="card-title">Editar {{ $user->name }}</h5>
			<form action="{{ action('UserController@atualiza') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" value="{{ $user->id }}" />
				<input type="text" value="{{ $user->name }}" name="name" placeholder="Nome" class="form-control mt-2" required />
	            <input type="email" value="{{ $user->email }}" name="email" placeholder="E-mail" class="form-control mt-2" required />
	            <input type="password" name="password" placeholder="Senha" class="form-control mt-2" required />
	            <input type="password" name="password2" placeholder="Confirmar Senha" class="form-control mt-2" required />
				<button class="btn btn-primary mt-3" type="submit">Salvar usuário</button>
			</form>
		</div>
	</div>
@stop
