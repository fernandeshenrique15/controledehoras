@extends('layout.principal')

@section('conteudo')
	<div class="table-responsive-md">
		<h3 class="title mt-4">Funcionários do {{ $department->name }}</h3>
		<table class="table table-striped table-hover">
			@if(empty($works))
				<div>Você não tem funcionários neste departamento</div><br>
			@else
				<thead class="thead-dark">
					<tr>
						<th>Nome</th>
						<th>Sobrenome</th>
						<th>E-mail</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($works as $w)
						<tr>
							<td>{{ $w->name or 'Não tem nome' }}</td>
							<td>{{ $w->lastname or 'Não tem sobrenome' }}</td>
							<td>{{ $w->email or 'Não tem e-mail' }}</td>
							<td>
								<a href="/work/mostra/{{ $w->id }}"><i class="zmdi zmdi-search zmdi-hc-lg"></i></a>
								<a href="/work/edita/{{ $w->id }}"><i class="zmdi zmdi-edit zmdi-hc-lg"></i></a>
								<a href="/work/remove/{{ $w->id }}"><i class="zmdi zmdi-delete zmdi-hc-lg"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			@endif
		</table>
	</div>
@stop
