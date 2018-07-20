@extends('layout.principal')

@section('conteudo')
<div class="card col-auto mx-auto mt-5">
	<div class="card-body">
		<h5 class="card-title">Cadastro de funcionário</h5>
		<form action="adiciona" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			<input type="hidden" name="idAccount" value="{{ $idAccount }}"/>
			<input type="text" name="name" placeholder="Nome" class="form-control mt-2" required>

			<input type="text" name="lastname" placeholder="Sobrenome" class="form-control mt-2" required>

			<select name="idDepartment" class="form-control mt-2" required>
                <option value="default" value="" disabled selected>Departamento</option>

				@foreach($departments as $d)
               		<option value="{{$d->id}}">{{$d->name}}</option>

                @endforeach
            </select>

			<input type="text" name="email" placeholder="E-mail" class="form-control mt-2" required>

			<button class="btn btn-primary mt-3" type="submit">Cadastrar</button>
		</form>
	</div>
</div>
@stop
