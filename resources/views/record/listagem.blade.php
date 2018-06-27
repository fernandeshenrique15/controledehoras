@extends('layout.principal')

@section('conteudo')
	@if(empty($records))
		<div class="alert alert-info my-3">Você não tem nenhum registro
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@else
	<div class="table-responsive-md">
		<h3 class="title mt-4">Listagem de registros</h3>
		<table class="table table-striped table-hover">
			<thead class="thead-dark">
				<tr>
					<th>Sobrenome</th>
					<th>Operação</th>
					<th>Tempo</th>
					<th>Realizada em</th>
					<th>Comentário</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
		@foreach ($records as $r)
				<tr>
					<td>{{ $r->idWork or 'Não tem sobrenome' }}</td>
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
