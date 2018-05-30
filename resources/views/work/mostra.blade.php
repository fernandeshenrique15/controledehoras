@extends('layout.principal')

@section('conteudo')
	<div class="panel panel-primary">
		<div class="panel-heading">Registros de {{ $work->lastname }}</div>
		<div class="panel-body">
			<table class="table table-striped table-hover">
				@if(empty($records))
					<div>Não há registros de {{ $work->lastname }}</div><br>
				@else

					<thead>
						<tr>
							<th>Operação</th>
							<th>Sobrenome</th>
							<th>Tempo</th>
							<th>Realizada em</th>
							<th>Cadastrada em</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($records as $r)
							<tr>
								<td>
									@if($r->mode == 'add')
										<span class="glyphicon glyphicon-plus"></span>
									@else
										<span class="glyphicon glyphicon-minus"></span>

									@endif
								</td>
								<td>{{ $work->lastname or 'Não tem sobrenome' }}</td>
								<td>{{ $r->hour or 'Não tem departamento' }}</td>
								<td>{{ $r->produced or ' ' }}</td>
								<td>{{ $r->comment or ' ' }}</td>
								<td>
									<a href="../../record/edita/{{ $r->id }}"><span class="glyphicon glyphicon-edit"></span></a>
									<a href="../../record/remove/{{ $r->id }}"><span class="glyphicon glyphicon-trash"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				@endif
			</table>
		</div>
	</div>
@stop
