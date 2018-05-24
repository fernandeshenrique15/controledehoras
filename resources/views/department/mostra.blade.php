@extends('layout.principal')

@section('conteudo')
	<div class="panel panel-primary">
		<div class="panel-heading">Funcionários do {{ $department->name }}</div>
		<div class="panel-body">
			<table class="table table-striped table-hover">
				@if(empty($works))
					<div>Você não tem funcionários neste departamento</div><br>
				@else
					<thead>
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
										<a href="/work/mostra/{{ $w->id }}"><span class="glyphicon glyphicon-search"></span></a>
										<a href="/work/edita/{{ $w->id }}"><span class="glyphicon glyphicon-edit"></span></a>
										<a href="/work/remove/{{ $w->id }}"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
						@endforeach
					</tbody>
				@endif
			</table>
		</div>
	</div>
@stop
