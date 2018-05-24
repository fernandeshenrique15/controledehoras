@extends('layout.principal')

@section('conteudo')
	@if(empty($works))
		<div>Você não tem nenhum funcionário cadastrado</div><br>
	@else
	<div class="panel panel-primary">
		<div class="panel-heading">Listagem de funcionários</div>
		<div class="panel-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Sobrenome</th>
						<th>Departamento</th>
						<th>E-mail</th>
						<th>Horas</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($works as $w)
					<tr>
						<td>{{ $w->name or 'Não tem nome' }}</td>
						<td>{{ $w->lastname or 'Não tem sobrenome' }}</td>
						<td>{{ $w->idDepartment or 'Não tem departamento' }}</td>
						<td>{{ $w->email or ' ' }}</td>
						<td>{{ $w->hours or ' ' }}</td>
						<td>
							<a href="/work/mostra/{{ $w->id }}"><span class="glyphicon glyphicon-search"></span></a>
							<a href="/work/edita/{{ $w->id }}"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="/work/remove/{{ $w->id }}"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif

	<a  class="btn btn-primary" href="{{ action('WorkController@novo') }}">Cadastrar Funcionário</a>

	@if(old('name'))
		<br><div class="alert alert-success">Funcionário {{ old('name') }} adicionado com sucesso!</div>
	@endif
@stop
