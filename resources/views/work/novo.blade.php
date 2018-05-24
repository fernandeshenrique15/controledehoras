@extends('layout.principal')

@section('conteudo')
<div class="panel panel-primary">
	<div class="panel-heading">Cadastro de funcionário</div>
		<div class="panel-body">
		<form action="adiciona" method="post">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<input type="text" name="name" placeholder="Nome" class="form-control" required>
				<br>
				<input type="text" name="lastname" placeholder="Sobrenome" class="form-control" required>
				<br>
				<select name="idDepartment" class="form-control" required>
	                <option value="default" value="" disabled selected>Departamento</option>

					@foreach($departments as $d)
	                <option value="{{$d->id}}">{{$d->name}}</option>

	                @endforeach
	            </select>
	            <br>
				<input type="text" name="email" placeholder="E-mail" class="form-control" required>
				<br>
				<button class="btn btn-primary" type="submit">Cadastrar</button>
			</div>
		</form>
		</div>
	</div>
</div>
@stop
