@extends('layout.principal')

@section('conteudo')
	@if(empty($records))
		<div>Você não tem nenhum registros</div><br>
	@else
	<div class="panel panel-primary">
		<div class="panel-heading">Listagem de registros</div>
		<div class="panel-body">
			<table class="table table-striped table-hover">
				<thead>
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
								<span class="glyphicon glyphicon-plus"></span>
							@else
								<span class="glyphicon glyphicon-minus"></span>

							@endif
						</td>
						<td>{{ $r->hour or 'Não tem hora' }}</td>
						<td>{{ $r->produced or ' ' }}</td>
						<td>{{ $r->comment or ' ' }}</td>
						<td>
							<a href="record/edita/{{ $r->id }}"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="record/remove/{{ $r->id }}"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif

	<a  class="btn btn-primary" href="{{ action('RecordController@novo') }}">Cadastrar Registro</a>

	@if(old('name'))
		<br><div class="alert alert-success">Registro de {{ old('name') }} adicionado com sucesso!</div>
	@endif
@stop
