@extends('layout.principal')

@section('conteudo')
	@if(empty($user))
        <div>Administrador não localizado</div><br>
    @else
		<div class="panel panel-primary">
			<div class="panel-heading">Editar {{ $user->name }}</div>
				<div class="panel-body">
				<form action="{{ action('UserController@atualiza') }}" method="post">
					<div class="form-group">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<input type="hidden" name="id" value="{{ $user->id }}" />
						<input type="text" value="{{ $user->name }}" name="name" placeholder="Nome" class="form-control" required />
			            <br>
			            <input type="email" value="{{ $user->email }}" name="email" placeholder="E-mail" class="form-control" required />
			            <br>
			            <input type="password" name="password" placeholder="Senha" class="form-control" required />
			            <br>
			            <input type="password" name="password2" placeholder="Confirmar Senha" class="form-control" required />
			            <br>
						<button class="btn btn-primary" type="submit">Salvar usuário</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	@endif

	@if(old('name'))
		<br><div class="alert alert-success">Useristrador {{ old('name') }} adicionado com sucesso!</div>
	@endif
@stop
