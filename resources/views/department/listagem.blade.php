@extends('layout.principal')

@section('conteudo')
	@if(count($departments) === 0)
		<div class="alert alert-info my-3">Você não tem nenhum departamento cadastrado</div>
	@else
	<div class="table-responsive-md">
		<h3 class="title mt-4">Listagem de departamentos</h3>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th>Nome</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($departments as $d)
				<tr>
					<td>{{ $d->name or 'Não tem nome' }}</td>
					<td>
						<a href="/department/mostra/{{ $d->id }}"><i class="zmdi zmdi-search zmdi-hc-lg"></i></a>
						<a href="/department/remove/{{ $d->id }}"><i class="zmdi zmdi-delete zmdi-hc-lg"></i></a>
					</td>
				</tr>
		@endforeach
			</tbody>
		</table>
	</div>
	@endif

	<div class="card col-auto mx-auto mt-5">
		<div class="card-body">
			<h5 class="card-title">Cadastro de departamento</h5>
			<form action="{{ action('DepartmentController@adiciona') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<input type="hidden" name="idAccount" value="{{ $idAccount }}"/>
				<input type="text" name="name" placeholder="Nome" class="form-control" required />
				<button class="btn btn-primary mt-3" type="submit">Cadastrar</button>
			</form>
		</div>
	</div>

@stop
