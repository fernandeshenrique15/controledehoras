@extends('layout.principal')

@section('conteudo')
	@if(empty($departments))
		<div class="alert alert-info my-3">Você não tem nenhum departamento cadastrado
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
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
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
					<input type="text" name="name" placeholder="Nome" class="form-control" required />
					<button class="btn btn-primary mt-3" type="submit">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>

@stop
