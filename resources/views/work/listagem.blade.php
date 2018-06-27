@extends('layout.principal')

@section('conteudo')
	@if(empty($works))
		<div>Você não tem nenhum funcionário cadastrado</div><br>
	@else
	<div class="table-responsive-md">
		<h3 class="title mt-4">Listagem de funcionários</h3>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th class="d-none d-md-table-cell">Nome</th>
					<th>Sobrenome</th>
					<th>Departamento</th>
					<th class="d-none d-md-table-cell">E-mail</th>
					<th>Horas</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($works as $w)
				<tr>
					<td class="d-none d-md-table-cell">{{ $w->name or 'Não tem nome' }}</td>
					<td>{{ $w->lastname or 'Não tem sobrenome' }}</td>
					<td>{{ $w->idDepartment or 'Não tem departamento' }}</td>
					<td class="d-none d-md-table-cell">{{ $w->email or ' ' }}</td>
					<td>{{ $w->hours or ' ' }}</td>
					<td>
						<a href="/work/mostra/{{ $w->id }}"><i class="zmdi zmdi-search zmdi-hc-lg"></i></a>
						<a href="/work/edita/{{ $w->id }}"><i class="zmdi zmdi-edit zmdi-hc-lg"></i></a>
						<a href="/work/remove/{{ $w->id }}"><i class="zmdi zmdi-delete zmdi-hc-lg"></i></a>
					</td>
				</tr>
		@endforeach
			</tbody>
		</table>
	</div>
	@endif

	<a  class="btn btn-primary" href="{{ action('WorkController@novo') }}"><i class="zmdi zmdi-account-add"></i> Cadastrar Funcionário</a>

	<div class="row">
		@if($positions['more']['name'])
		<div class="col-sm-6">
			<div class="card mt-5" >
				<div class="card-body">
					<h5 class="card-title">Mais Hora</h5>
					<h6 class="card-subtitle mb-2 text-muted">Funcionário com mais hora extra</h6>
				 	<ul class="list-group list-group-flush">
				 		<li class="list-group-item">{{$positions['more']['name']}}</li>
						<li class="list-group-item">Horas: {{$positions['more']['value']}}</li>
						<li class="list-group-item">Departamento: {{$positions['more']['department']}}</li>
					</ul>
					<a href="work/emailMore/{{$positions['more']['id']}}" class="btn btn-primary mt-4">Avisar por e-mail</a>
				</div>
			</div>
		</div>
		@endif
		@if($positions['less']['name'])
		<div class="col-sm-6">
			<div class="card mt-5" >
				<div class="card-body">
					<h5 class="card-title">Menos hora</h5>
					<h6 class="card-subtitle mb-2 text-muted">Funcionário com menos hora extra</h6>
				 	<ul class="list-group list-group-flush">
				 		<li class="list-group-item">{{$positions['less']['name']}}</li>
						<li class="list-group-item">Horas: {{$positions['less']['value']}}</li>
						<li class="list-group-item">Departamento: {{$positions['less']['department']}}</li>
					</ul>
					<a href="work/emailMore/{{$positions['less']['id']}}" class="btn btn-primary mt-4">Avisar por e-mail</a>
				</div>
			</div>
		</div>
		@endif
	</div>

@stop
