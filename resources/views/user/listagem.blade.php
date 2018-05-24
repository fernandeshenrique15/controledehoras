@extends('layout.principal')

@section('conteudo')
	<div class="panel panel-primary">
		<div class="panel-heading">Listagem de usuário</div>
		<div class="panel-body">
			<table class="table table-striped table-hover">
				@if(empty($users))
					<div>Você não tem nenhum administrador cadastrado</div><br>
				@else
					<thead>
						<tr>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Atualizado em</th>
							<th>Cadastrado em</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $u)
							<tr>
								<td>{{ $u->name or 'Não tem nome' }}</td>
								<td>{{ $u->email or 'Não tem e-mail' }}</td>
								<td>{{ $u->updated_at }}</td>
								<td>{{ $u->created_at }}</td>
								<td>
									<a href="/user/edita/{{ $u->id }}"><span class="glyphicon glyphicon-edit"></span></a>
									<a href="/user/remove/{{ $u->id }}"><span class="glyphicon glyphicon-trash"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				@endif
			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">Cadastro de usuário</div>
			<div class="panel-body">
			<form action="{{ action('UserController@adiciona') }}" method="post">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="text" name="name" placeholder="Nome" class="form-control" required />
		            <br>
		            <input type="email" name="email" placeholder="E-mail" class="form-control" required />
		            <br>
		            <input type="password" name="password" placeholder="Senha" class="form-control" required />
		            <br>
					<button class="btn btn-primary" type="submit">Cadastrar usuário</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	@if(old('name'))
		<br><div class="alert alert-success">Useristrador {{ old('name') }} adicionado com sucesso!</div>
	@endif
@stop
