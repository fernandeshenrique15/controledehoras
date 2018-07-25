@extends('layout.principal')

@section('conteudo')
	<div class="card col-auto mx-auto mt-5">
		<div class="card-body">
			<h5 class="card-title">Editar {{ $work->name or 'Sem nome' }} {{ $work->lastname }}</h5>
			<form action="atualiza" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<input type="hidden" name="idAccount" value="{{ $idAccount }}"/>
				<input type="hidden" name="id" value="{{ $work->id }}"/>
				<input type="text" value="{{ $work->name }}" name="name" placeholder="Nome" class="form-control mt-2" required>
				<input type="text" value="{{ $work->lastname }}" name="lastname" placeholder="Sobrenome" class="form-control mt-2" required>
				<select name="idDepartment" class="form-control mt-2" required>
	                <option value="" disabled>Departamento</option>

					@foreach($departments as $d)
	                <option value="{{$d->id}}" @if ($d->id == $work->idDepartment) selected @endif>{{$d->name}}</option>

	                @endforeach
	            </select>
				<input type="text" value="{{ $work->email }}" name="email" placeholder="E-mail" class="form-control mt-2" required>
				<button class="btn btn-primary mt-3" type="submit">Salvar</button>
			</form>
		</div>
	</div>
@stop
