@extends('layout.principal')

@section('conteudo')
<div class="panel panel-primary">
	<div class="panel-heading">Cadastro de funcionário</div>
		<div class="panel-body">
			@if(empty($work))
                <div>Funcionário não localizado</div><br>
            @else
				<form action="atualiza" method="post">
					<div class="form-group">
						<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						<input type="hidden" name="id" value="{{ $work->id }}"/>
						<input type="text" value="{{ $work->name }}" name="name" placeholder="Nome" class="form-control" required>
						<br>
						<input type="text" value="{{ $work->lastname }}" name="lastname" placeholder="Sobrenome" class="form-control" required>
						<br>
						<select name="idDepartment" class="form-control" required>
			                <option value="" disabled>Departamento</option>

							@foreach($departments as $d)
			                <option value="{{$d->id}}" @if ($d->id == $work->idDepartment) selected @endif>{{$d->name}}</option>

			                @endforeach
			            </select>
			            <br>
						<input type="text" value="{{ $work->email }}" name="email" placeholder="E-mail" class="form-control" required>
						<br>
						<button class="btn btn-primary" type="submit">Cadastrar</button>
					</div>
				</form>
			@endif
		</div>
	</div>
</div>
@stop
