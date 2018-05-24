@extends('layout.principal')

@section('conteudo')
	@if(empty($departments))
		<div>Você não tem nenhum departamento cadastrado</div><br>
	@else
	<div class="panel panel-primary">
		<div class="panel-heading">Listagem de departamentos</div>
		<div class="panel-body">
			<table class="table table-striped table-hover">
				<thead>
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
							<a href="/department/mostra/{{ $d->id }}"><span class="glyphicon glyphicon-search"></span></a>
							<a href="/department/remove/{{ $d->id }}"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif

	<div class="panel panel-primary">
		<div class="panel-heading">Cadastro de departamento</div>
			<div class="panel-body">
			<form action="{{ action('DepartmentController@adiciona') }}" method="post">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
					<input type="text" name="name" placeholder="Nome" class="form-control" required />
		            <br>
					<button class="btn btn-primary" type="submit">Cadastrar</button>
				</div>
			</form>
			</div>
		</div>
	</div>
@stop
