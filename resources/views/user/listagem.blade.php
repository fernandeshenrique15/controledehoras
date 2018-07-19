@extends('layout.principal')

@section('conteudo')
	<div class="table-responsive-md">
		<h3 class="title mt-4">Listagem de usuários</h3>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
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
							<a href="/user/edita/{{ $u->id }}"><i class="zmdi zmdi-edit zmdi-hc-lg"></i></a>
							<a href="/user/remove/{{ $u->id }}"><i class="zmdi zmdi-delete zmdi-hc-lg"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="card col-auto mx-auto mt-5">
		<div class="card-body">
			<h5 class="card-title">Cadastrar usuário</h5>
			<form action="{{ action('UserController@adiciona') }}" method="post">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="idAccount" value="{{ $idAccount }}"/>
					<input type="text" name="name" placeholder="Nome" class="form-control mt-2" required />

		            <input type="email" name="email" placeholder="E-mail" class="form-control mt-2" required />

		            <input type="password" name="password" placeholder="Senha" class="form-control mt-2" required />

		            <input type="password" name="password2" placeholder="Confirmar senha" class="form-control mt-2" required />

					<button class="btn btn-primary mt-3" type="submit">Cadastrar usuário</button>
				</div>
			</form>
		</div>
	</div>

@stop
