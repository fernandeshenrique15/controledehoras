@extends('layout.principal')

@section('conteudo')
	@if(count($records) === 0)
		<div class="alert alert-info my-3">Não há registros</div>
	@else
		<div class="table-responsive-md">
			<h3 class="title mt-4">Listagem de registros</h3>
			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th><a href="@if($sort == 'work') ?o=work&s=asc @else ?o=work @endif" class="text-white">Nome</a></th>
						<th><a href="@if($sort == 'mode') ?o=mode&s=asc @else ?o=mode @endif" class="text-white">Operação</a></th>
						<th><a href="@if($sort == 'hour') ?o=hour&s=asc @else ?o=hour @endif" class="text-white">Tempo</a></th>
						<th><a href="@if($sort == 'produced') ?o=produced&s=asc @else ?o=produced @endif" class="text-white">Realizada em</a></th>
						<th>Comentário</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
			@foreach ($records as $r)
					<tr>
						<td>{{ $r->work->name or 'Sem nome' }} {{ $r->work->lastname }}</td>
						<td>
							@if($r->mode == 'add')
								<i class="zmdi zmdi-plus zmdi-hc-lg"></i>
							@else
								<i class="zmdi zmdi-minus zmdi-hc-lg"></i>

							@endif
						</td>
						<td>{{ $r->hour or 'Não tem hora' }}</td>
						<td>{{ $r->produced or ' ' }}</td>
						<td>{{ $r->comment or ' ' }}</td>
						<td>
							<a href="record/edita/{{ $r->id }}"><i class="zmdi zmdi-edit zmdi-hc-lg"></i></a>
							<a href="record/remove/{{ $r->id }}"><i class="zmdi zmdi-delete zmdi-hc-lg"></i></a>
						</td>
					</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	@endif

		<a  class="btn btn-primary" href="{{ action('RecordController@novo') }}"><i class="zmdi zmdi-time"></i> Cadastrar Registro</a>

@stop
